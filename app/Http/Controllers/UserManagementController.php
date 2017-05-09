<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $adminRepository = new AdminRepository();
        $users = $adminRepository->getUser();

        return view('admin.user', [
            'users' => $users
        ]);
    }
}
