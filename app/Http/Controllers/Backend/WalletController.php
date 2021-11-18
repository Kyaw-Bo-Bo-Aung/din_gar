<?php

namespace App\Http\Controllers\Backend;

use App\Wallet;
use App\User;
use App\Transaction;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletRequest;
use App\Helpers\UUIDGenerator;
use App\Notifications\GeneralNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class WalletController extends Controller
{
    public function index() {
        return view('backend.wallet.index');
    }

    public function ssd() {
        $wallets = Wallet::query();
        return Datatables::of($wallets)
                ->addColumn('account_user', function($each){
                    $user = $each->user;
                    if(!$user){
                        return '-';
                    }
                    return '<p>Name: '.$user->name.'</p><p>Email: '.$user->email.'</p><p>Phone: '.$user->phone.'</p>';
                })
                ->editColumn('amount', function($each) {
                    return number_format($each->amount,2);
                })
                ->rawColumns(['account_user'])
                ->make(true);
    }
    public function addWalletForm() {
        $users = User::with('wallet')->get();
        return view('backend.wallet.add-wallet', compact('users'));
    }
    public function reduceWalletForm() {
        $users = User::with('wallet')->get();
        return view('backend.wallet.reduce-wallet', compact('users'));
    }
    
    public function addWallet(WalletRequest $request){
        $to_user = User::with('wallet')->where('id', $request->user_id)->firstOrFail();
        $agent = Auth::guard('admin_user')->user();
        if ($request->amount < 1000) {
            return back()->withErrors(['Fail' => 'Amount must be at least 1000 MMK'])->withInput();
        }
        DB::beginTransaction();
        try {

            $to_account_wallet = $to_user->wallet;
            $to_account_wallet->increment('amount', $request->amount);
            $to_account_wallet->update();

            $to_account_transaction = new Transaction;
            $to_account_transaction->ref_no = UUIDGenerator::refNumber();
            $to_account_transaction->trx_id = UUIDGenerator::trxId();
            $to_account_transaction->user_id = $to_user->id;
            $to_account_transaction->type = 1;
            $to_account_transaction->amount = $request->amount;
            $to_account_transaction->source_id = 0; //for admin_user_id
            $to_account_transaction->description = $request->description;
            $to_account_transaction->save();
            // for to_account noti
            $title = 'Money Recieved!';
            $message = 'Recieved '. number_format($request->amount,2) .' MMK from the admin ('.$agent->name. ').';
            $sourceId = $to_account_transaction->trx_id;
            $sourceType = Transaction::class;
            $web_link = url('/transactions/'.$to_account_transaction->trx_id);
            Notification::send($to_user, new GeneralNotification($title, $message, $sourceId, $sourceType, $web_link));
            DB::commit();

           return redirect('/admin/wallet')->with('create', 'Wallet Money added successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Fail' => 'Something Wrong. Invalid data'])->withInput();
        }    
    }

    public function reduceWallet(WalletRequest $request){
        $to_user = User::with('wallet')->where('id', $request->user_id)->firstOrFail();
        $agent = Auth::guard('admin_user')->user();
        if ($request->amount <= 0) {
            return back()->withErrors(['Fail' => 'Amount must be at least 1 MMK'])->withInput();
        }
        DB::beginTransaction();
        try {
            $to_account_wallet = $to_user->wallet;

            if ($to_account_wallet->amount < $request->amount) {
                throw new Exception("Your amount is greater than wallet money");
            }
            $to_account_wallet->decrement('amount', $request->amount);
            $to_account_wallet->update();

            $to_account_transaction = new Transaction;
            $to_account_transaction->ref_no = UUIDGenerator::refNumber();
            $to_account_transaction->trx_id = UUIDGenerator::trxId();
            $to_account_transaction->user_id = $to_user->id;
            $to_account_transaction->type = 2;
            $to_account_transaction->amount = $request->amount;
            $to_account_transaction->source_id = 0; //for admin_user_id
            $to_account_transaction->description = $request->description;
            $to_account_transaction->save();
            // for to_account noti
            $title = 'Money reduced!';
            $message = number_format($request->amount,2) .' MMK is reduced by the admin ('.$agent->name. ').';
            $sourceId = $to_account_transaction->trx_id;
            $sourceType = Transaction::class;
            $web_link = url('/transactions/'.$to_account_transaction->trx_id);
            Notification::send($to_user, new GeneralNotification($title, $message, $sourceId, $sourceType, $web_link));
            DB::commit();

           return redirect('/admin/wallet')->with('reduce', 'Wallet Money reduced successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Fail' => 'Something Wrong.'.$e->getMessage()])->withInput();
        }    
    }
}
