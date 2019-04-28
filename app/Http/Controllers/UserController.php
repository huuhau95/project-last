<?php

namespace App\Http\Controllers;

use Session;
use Cache;
use Redis;

use App\User;
use App\Role;
use App\Repositories\Repository;

use Yajra\Datatables\Datatables;
use Pusher\Pusher;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    protected $userModel;
    protected $roleModel;

    public function __construct(User $userModel, Role $roleModel)
    {
        $this->userModel = new Repository($userModel);
        $this->roleModel = new Repository($roleModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleModel->all();

        return view('admin.user_list', compact('roles'));
    }

    public function json()
    {
        // if (!Redis::get('user:all')) {
        //     // $name, $with from repository
        //     $this->userModel->setRedisAll('user:all', ['role']);
        // }

        // // set true to return array
        // $data = json_decode(Redis::get('user:all'), true);

        $data = User::all()->load('role');

        return datatables($data)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $newName = str_random(4) . '_' . $name;

            while (file_exists(config('asset.image_path.avatar') . $newName)) {
                $newName = str_random(4) . '_' . $name;
            }

            $file->move(config('asset.image_path.avatar'), $newName);

            $image = $newName;
        } else {
            $image = null;
        }

        $user = $this->userModel->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'active' => 1,
            'image' => $image,
        ]);

        // // $name, $with
        // $this->userModel->setRedisAll('user:all', ['role']);
        // // $name, $id, $data
        // $this->userModel->setRedisById('user:' . $user->id, $user);

        return 'success';
    }

    /**
     * edit my profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('admin.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role_id == 1) {
            if ($user->role_id == 1 && $currentUser->email != $user->email) {
                abort(403);
            }
        } else {
            if ($currentUser->email != $user->email) {
                abort(403);
            }
        }

        $password = $user->password;

        if ($request->password != '') {
            $password = Hash::make($request->password);
        }

        $newName = $user->image;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $newName = str_random(4) . '_' . $name;

            // kiem tra de tranh trung lap ten file
            while (file_exists(config('asset.image_path.avatar') . $newName)) {
                $newName = str_random(4) . '_' . $name;
            }

            if (file_exists(config('asset.image_path.avatar') . $user->image) && $user->image) {
                unlink(config('asset.image_path.avatar') . $user->image);
            }

            $file->move(config('asset.image_path.avatar'), $newName);
        }

        $data = $this->userModel->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $newName,
                'password' => $password,
                'image' => $newName,
            ],
            $user->id
        );

        // $this->userModel->setRedisAll('user:all', ['role']);
        // $this->userModel->setRedisById('user:' . $user->id, $data);

        return __('message.success.update');
    }

    public function active(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role_id == 1) {
            if ($user->role_id == 1 && $user->active == 1) {
                abort(403);
            } else {
                $data = $this->userModel->update(['active' => $user->active == 1 ? 0 : 1], $user->id);

                // $this->userModel->setRedisAll('user:all', ['role']);
                // $this->userModel->setRedisById('user' . $user->id, User::where('id', $user->id)->get());

                $check = ($user->active == 1 ? 0 : 1);

                if ($check == 0) {
                    return response()->json($user);
                }

                return 'actived';
            }
        }

        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role_id == 1 && $user->role_id != 1) {
            $user->delete();
            // $this->userModel->setRedisAll('user:all', ['role']);

            // $this->userModel->deleteRedis('user' . $user->id);

            return __('message.success.delete');
        }

        abort(403);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->role_id == 3) {
                return redirect(route('client.index'));
            }

            return redirect()->route('admin.index');
        }

        return back()->with('fail', 'Email hoặc mật khẩu không đúng !');
    }

    public function logoutAdmin()
    {
        Auth::logout();

        return redirect(route('login'));
    }

    public function logoutUser()
    {
        Auth::logout();

        return redirect(route('client.index'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }
}
