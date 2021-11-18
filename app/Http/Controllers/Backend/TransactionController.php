<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Transaction;
use App\User;
use DateTime;

class TransactionController extends Controller
{
    public function index() {
        // $date = new DateTime();
        // dd(now()->todateTimeString());
        return view('backend.transaction.index');
    }
    public function show($id) {
        $transaction = Transaction::with(['user', 'source'])->where('trx_id', $id)->firstOrFail();
        return view('backend.transaction.show', compact('transaction'));
    }

    public function ssd () 
    {
        $transactions = Transaction::query();
        // return($transactions);
        return Datatables::of($transactions)
        ->editColumn('type', function($transaction){
            if ($transaction->type == '1') {
                return '<div class="badge badge-success rounded-pill px-2">Income</div>';
            }elseif($transaction->type = '2'){
                return '<div class="badge badge-danger rounded-pill px-2">Expense</div>';
            }
        })
        ->editColumn('created_at', function($transaction){
            return $transaction->created_at->format('Y-m-d H:i:s');
        })
        ->editColumn('amount', function($transaction){
            return number_format($transaction->amount);
        })
        ->editColumn('user_id', function($transaction){
            $user = User::where('id', $transaction->user_id)->firstOrFail();
            if (!$user) {
                return '-';
            }
            return $user->phone;
        })
        ->editColumn('source_id', function($transaction){
            if ($transaction->source_id == '0') {
                return '-';
            }
            $user = User::where('id', $transaction->source_id)->firstOrFail();
            return $user->phone;
        })
        ->addColumn('action', function ($transaction) {
                $action_btn =  "<a class='p-2 mx-1' href='". route('admin.transactions.show', $transaction->trx_id) ."''><i class='btn btn-info btn-sm fas fa-info-circle'> more</i></a>";
                return '<div class="">'. $action_btn . '</div>';
            })
        ->rawColumns(['type', 'action'])
        ->make(true);
    }
    public function todayTrxssd()
    {
        $transactions = Transaction::whereDay('created_at', now()->day)->get();
        return Datatables::of($transactions)
        ->editColumn('type', function($transaction){
            if ($transaction->type == '1') {
                return '<div class="badge badge-success rounded-pill px-2">Income</div>';
            }elseif($transaction->type = '2'){
                return '<div class="badge badge-danger rounded-pill px-2">Expense</div>';
            }
        })
        ->editColumn('created_at', function($transaction){
            return $transaction->created_at->format('H:i:s');
        })
        ->editColumn('amount', function($transaction){
            return number_format($transaction->amount);
        })
        ->editColumn('user_id', function($transaction){
            $user = User::where('id', $transaction->user_id)->firstOrFail();
            if (!$user) {
                return '-';
            }
            return $user->phone;
        })
        ->editColumn('source_id', function($transaction){
            if ($transaction->source_id == '0') {
                return '-';
            }
            $user = User::where('id', $transaction->source_id)->firstOrFail();
            return $user->phone;
        })
        ->addColumn('action', function ($transaction) {
                $action_btn =  "<a class='p-2 mx-1' href='". route('admin.transactions.show', $transaction->trx_id) ."''><i class='btn btn-info btn-sm fas fa-info-circle'> more</i></a>";
                return '<div class="">'. $action_btn . '</div>';
            })
        ->rawColumns(['type', 'action'])
        ->make(true);
    }

}
