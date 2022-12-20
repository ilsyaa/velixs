<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Helpers\Metavis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Metavis::lyna('admin.users.index', [
            'show' => 'users',
        ]);
    }

    public function json($show)
    {
        if ($show == 'users') {
            $users = User::all();
        } else {
            $users = User::onlyTrashed()->get();
        }
        return datatables()->of($users)
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('role', function ($user) {
                return $user->role == 'admin' ? '<span class="badge badge-light-danger">Admin</span>' : '<span class="badge badge-light-primary">User</span>';
            })
            ->addColumn('main', function ($user) {
                return '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar  me-1"><img src="' . $user->avatar() . '" alt="Avatar" height="32" width="32"></div></div><div class="d-flex flex-column"><a href="javascript:void()" class="user_name text-truncate text-body"><span class="fw-bolder">' . $user->name . '</span></a><small class="emp_post text-muted">' . $user->email . '</small></div></div>';
            })
            ->addColumn('action', function ($user) {
                return '    <div class="d-inline-flex">
                <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="' . route('product.license.index', ['username' => $user->username]) . '" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text me-50 font-small-4">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>License Owned
                    </a>
                </div>
            </div>
            <a href="' . route('users.edit', $user->id) . '" class="item-edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </a>';
            })
            ->addColumn('recovery', function ($user) {
                return '<a href="' . route('users.recovery', $user->id) . '" class="btn btn-sm btn-warning">Recovery</a>';
            })
            ->addColumn('join_at', function ($user) {
                return $user->created_at->format('d M Y');
            })
            ->addColumn('delete_at', function ($user) {
                return date('d M Y', strtotime($user->deleted_at));
            })
            ->addColumn('status', function ($user) {
                return $user->email_verified_at ? '<span class="badge badge-light-success">Verify</span>' : '<span class="badge badge-light-danger">Unverify</span>';
            })
            ->rawColumns(['action', 'recovery', 'main', 'role', 'status'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return Metavis::lyna('admin.users.trash', [
            'show' => 'trash'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Metavis::lyna('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function removeavatar(User $user)
    {
        if ($user->avatar) {
            Storage::delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }
        return redirect()->back()->with('success', 'Avatar has been removed');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => ['required', 'alpha_dash', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'role' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'confirm-new-password' => ['same:new_password'],
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                if (Storage::exists($user->avatar)) {
                    Storage::delete($user->avatar);
                }
            }
            $user->avatar = $request->file('avatar')->store('avatar');
        }

        if ($request->new_password) {
            $user->password = bcrypt($request->new_password);
        }

        $user->save();
        if ($request->btn == 'save only') {
            return redirect()->route('users.index')->with('success', 'User has been updated');
        } else {
            return redirect()->route('users.edit', $user->id)->with('success', 'User has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyall(Request $request)
    {
        $ids = $request->id;
        User::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Users Deleted successfully."]);
    }

    public function recovery($id)
    {
        User::withTrashed()->where('id', $id)->restore();
        return redirect()->route('users.trash')->with('success', 'User has been recovery');
    }

    public function forcedelete(Request $request)
    {
        $users = User::onlyTrashed()->whereIn('id', $request->id);
        foreach ($users->get() as $user) {
            if ($user->avatar) {
                if (Storage::exists($user->avatar)) {
                    Storage::delete($user->avatar);
                }
            }
        }
        $users->forceDelete();
        return response()->json(['success' => "Users Deleted successfully."]);
    }
}
