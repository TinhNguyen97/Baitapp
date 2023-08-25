<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAllPaginate(5);
        return view('users.index', ['users' => $users]);
    }
    public function handleActive($id)
    {
        $user = $this->userService->find($id);
        if ($user->is_admin) {
            return back()->with(['errorlock' => true]);
        };
        $isActive = $user->is_active;
        $email = $user->email;
        if ($isActive) {
            $this->userService->update(['is_active' => 0], $id);
            return back()->with(['locksuccess' => true, 'email' => $email]);
        } else {
            $this->userService->update(['is_active' => 1], $id);
        };
        return back()->with(['unlocksuccess' => true, 'email' => $email]);
    }

    public function handleDelete($id)
    {

        $user = $this->userService->find($id);
        abort_if(!$user, 404);
        if ($user->is_admin) {
            return back()->with(['preventDelete' => true]);
        };
        $this->userService->delete($id);
        return back()->with(['isDeleteSuccess' => true]);
    }

    public function search(Request $request)
    {
        $users = $this->userService->searchByNameOrEmail($request->key);
        return view('users.search', ['users' => $users, 'request' => $request]);
    }
    public function activeAdmin($id)
    {
        $user = $this->userService->find($id);
        if (!$user->is_active) {
            return back()->with(['neededUnlock' => true]);
        }
        if ($user->is_admin) {
            return back()->with(['admined' => true]);
        };
        $this->userService->update(['is_admin' => 1], $id);
        return back()->with(['adminsuccess' => true]);
    }
}
