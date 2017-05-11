<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

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
        try{

            $userRepository = new UserRepository();
            $user = $userRepository->addUser($request);

            $role = Role::find(2);
            $user->roles()->attach($role);

            return new JsonResponse([$user, 200]);

        } catch(\Exception $e){
            throw $e;
        }

    }

    public function destroy($id)
    {
        try{
            $user = User::find($id);
            $user->roles()->detach();

            $userRepository = new UserRepository();
            $user = $userRepository->deleteUser($id);

            return;

        } catch (\Exception $e){
            throw $e;
        }
    }

}
