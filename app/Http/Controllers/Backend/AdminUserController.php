<?php
namespace App\Http\Controllers\Backend;
use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUser;
use App\Http\Requests\UpdateAdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Jenssegers\Agent\Agent;

class AdminUserController extends Controller
{
    public function index(){
    	$users = AdminUser::all();
    	return view('backend.admin-user.index', compact('users'));
    }

    // server side data
    public function ssd() {
    	$admin_users = AdminUser::query()->where('id', '!=' ,auth('admin_user')->user()->id);
    	return Datatables::of($admin_users)
            ->editColumn('user_agent', function($user) {
                if (!$user->user_agent) {
                    return '-';
                }
                $agent = new Agent();
                $agent->setUserAgent($user->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                return '<table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th><small>Device</small></th>
                                <td><small>'.$device.'</small></td>
                            </tr>
                            <tr>
                                <th><small>Platform</small></th>
                                <td><small>'.$platform.'</small></td>
                            </tr>
                            <tr>
                                <th><small>Browser</small></th>
                                <td><small>'.$browser.'</small></td>
                            </tr>
                        </tbody>
                        </table>';
            })
            ->addColumn('action', function ($admin_user) {
                $action_btn =  "<a class='p-2 mx-1' href='". route('admin.admin-user.edit', $admin_user->id) ."''><i class='text-warning fa fa-edit'></i></a><a data-id='".$admin_user->id."' class='delete_btn p-2 mx-1' href=''><i class='text-danger fa fa-trash'></i></a>";
                return '<div class="action_btn">'. $action_btn . '</div>';
            })
            ->rawColumns(['user_agent', 'action'])
            ->make(true);
    }

    public function create() {
    	return view('backend.admin-user.create');
    }

    public function store(StoreAdminUser $request) {
        $admin_user = new AdminUser;
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->phone = $request->phone;
        $admin_user->password = Hash::make($request->password);
        $admin_user->save();
        return redirect()->route('admin.admin-user.index')->with('create', 'Successfully Created');
    }

    public function edit(AdminUser $admin_user)
    {
        return view('backend.admin-user.edit', compact('admin_user'));
    }

    public function update($id, UpdateAdminUser $request)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->phone = $request->phone;
        $admin_user->password = $request->password ? Hash::make($request->password) : $admin_user->password;
        $admin_user->update();
        return redirect()->route('admin.admin-user.index')->with('update', 'Successfully Updated');
    }

    public function destroy($id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->delete();
    } 
}
