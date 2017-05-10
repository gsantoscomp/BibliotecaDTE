<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserManagementController extends Controller
{
    public function index()
    {
        $userRepository = new UserRepository();
        $users = $userRepository->getUser();

        return view('admin.user', [
            'users' => $users
        ]);
    }

    public function store(UserRequest $request)
    {


    }
}
