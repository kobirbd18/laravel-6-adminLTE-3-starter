<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\AdminPermissionGroup;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminController extends Controller {
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function changePassword() {
        return view('admin.admins.changePassword');
    }

    public function changePasswordStore(Request $request) {
        $messages = [
            'old_password.required' => 'Current password is required',
            'old_password.old_password' => 'Current password is wrong',
            'password.required' => 'New Password is required',
            'password.confirmed' => 'New Passwords does not match',
            'password.min' => 'New Password must be at least 6 char long',
            'password.max' => 'New Password can be maximum 200 char long',
        ];

        $this->validate($request, [
            'old_password' => 'required|old_password:' . Auth::guard('admin')->user()->password,
            'password' => 'required|confirmed|min:6|max:255',
        ], $messages);

        $admin = Auth::guard('admin')->user();

        $admin['password'] = bcrypt($request->get('password'));

        $admin->save();

        Session::flash('success', 'Your password has been changed');

        return redirect()->route('admin.changePassword');
    }

    public function index(Request $request) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-read'])) {
            $admins = Admin::orderBy('name', 'ASC');

            if ($request->get('name')) {
                $admins->where('name', 'LIKE', '%' . $request->get('name') . '%');
            }

            if ($request->get('email')) {
                $admins->where('email', 'LIKE', '%' . $request->get('email') . '%');
            }

            if ($request->get('role_id')) {
                $admins->where('role_id', $request->get('role_id'));
            }

            $admins = $admins->with('role')->paginate(50);
            $roles = Role::pluck('display_name', 'id')->all();
            return view('admin.admins.index', compact('admins', 'roles'));
        } else {
            return view('error.admin-unauthorized');
        }
    }

    public function create(Request $request) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-create'])) {
            $display = 'none';
            if (old('role_id') && old('role_id') > 1) {
                $display = 'block';
            }
            $permissionGroups = AdminPermissionGroup::where('status', 1)->with('permissions')->get();
            $roles = Role::pluck('display_name', 'id')->all();
            return view('admin.admins.create', compact('permissionGroups', 'roles', 'display'));
        } else {
            return view('error.admin-unauthorized');
        }
    }

    public function store(Request $request) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-create'])) {
            $messages = [
                'role_id.required' => 'The Role field is required',
                'name.required' => 'The Name field is required',
                'email.required' => 'The Email field is required',
                'email.unique' => 'The Email already exists',
                'phone.required' => 'The Phone field is required',
                'phone.bd_mobile' => 'Invalid Phone number format.',
                'phone.unique' => 'The Phone already exists',
                'password.required' => 'The Password field is required',
                'password_confirmation.required' => 'The Confirm Password field is required',
            ];

            $this->validate($request, [
                'role_id' => 'required',
                'name' => 'required',
                'phone' => [
                    'required',
                    'bd_mobile',
                    Rule::unique('admins', 'phone')->whereNull('deleted_at'),
                ],
                'email' => [
                    'required',
                    Rule::unique('admins', 'email')->whereNull('deleted_at'),
                    'email',
                ],
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ], $messages);

            $input = $request->all();

            unset($input['password_confirmation']);

            $input['password'] = bcrypt($request->get('password'));
            $input['admin_id'] = Auth::guard('admin')->user()->id;
            $admin = Admin::create($input);

            if ($admin->role_id == 2) {
                if ($request->get('permissions')) {
                    $admin->permissions()->sync($request->get('permissions'));
                }
            }

            $admin->attachRole($input['role_id']);

            Session::flash('success', 'The Admin has been created');

            return redirect()->route('admin.admins.index');
        } else {
            return view('error.admin-unauthorized');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-update'])) {
            $admin = Admin::findOrFail($id);
            $permissionGroups = AdminPermissionGroup::where('status', 1)->with('permissions')->get();
            $display = 'none';
            if (old('role_id') && old('role_id') > 1 || $admin->role_id > 1) {
                $display = 'block';
            }
            $roles = Role::pluck('display_name', 'id')->all();
            return view('admin.admins.edit', compact('admin', 'permissionGroups', 'roles', 'display'));
        } else {
            return view('error.admin-unauthorized');
        }
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-update'])) {
            $messages = [
                'role_id.required' => 'The Role field is required',
                'name.required' => 'The Name field is required',
                'email.required' => 'The Email field is required',
                'email.unique' => 'The Email already exists',
                'phone.required' => 'The Phone field is required',
                'phone.bd_mobile' => 'Invalid Phone number format.',
                'phone.unique' => 'The Phone already exists',
                'password.required' => 'The Password field is required',
                'password_confirmation.required' => 'The Confirm Password field is required',
            ];

            $rules = [
                'role_id' => 'required',
                'name' => 'required',
                'phone' => [
                    'required',
                    'bd_mobile',
                    Rule::unique('admins', 'phone')->whereNull('deleted_at')->ignore($id),
                ],
                'email' => [
                    'required',
                    Rule::unique('admins', 'email')->whereNull('deleted_at')->ignore($id),
                    'email',
                ],
            ];

            $this->validate($request, $rules, $messages);

            $input = $request->all();
            if (!$request->has('status')) {
                $input['status'] = 0;
            }

            $input['admin_id'] = Auth::guard('admin')->user()->id;

            $admin = Admin::findOrFail($id);
            $admin->update($input);

            if ($admin->role_id == 2) {
                if ($request->get('permissions')) {
                    $admin->permissions()->sync($request->get('permissions'));
                } else {
                    $admin->permissions()->sync([]);
                }
            } else {
                $admin->permissions()->sync([]);
            }

            $admin->syncRoles([$input['role_id']]);

            Session::flash('success', 'The Admin has been updated');

            return redirect()->route('admin.admins.index');
        } else {
            return view('error.admin-unauthorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-delete'])) {
            if (Auth::guard('admin')->user()->id == $id) {
                Session::flash('error', 'You cannot delete your own account');

                return redirect()->route('admin.admins.index');
            } else {
                $admin = Admin::findOrFail($id);
                $admin->update([
                    'admin_id' => Auth::guard('admin')->user()->id,
                ]);

                $admin->permissions()->sync([]);
                $admin->syncRoles([]);

                $admin->delete();

                Session::flash('success', 'The Admin has been deleted');

                return redirect()->route('admin.admins.index');
            }
        } else {
            return view('error.admin-unauthorized');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-update'])) {
            $admin = Admin::findOrFail($id);
            return view('admin.admins.resetPassword', compact('admin'));
        } else {
            return view('error.admin-unauthorized');
        }
    }

    public function resetPasswordStore($id, Request $request) {
        if (Auth::guard('admin')->user()->hasRole('admin') || Auth::guard('admin')->user()->hasPermission(['admin-admins-update'])) {
            $messages = [
                'password.required' => 'Password field is required',
                'password_confirmation.required' => 'Confirm Password field is required',
            ];

            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ], $messages);

            $input = $request->only('password');
            $input['password'] = bcrypt($request->get('password'));
            $input['admin_id'] = Auth::guard('admin')->user()->id;
            $admin = Admin::findOrFail($id);
            $admin->update($input);

            Session::flash('success', 'Admin User password has been updated');
            return redirect()->route('admin.admins.index');
        } else {
            return view('error.admin-unauthorized');
        }
    }
}
