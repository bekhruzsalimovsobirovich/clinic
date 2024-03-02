<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->orderByDesc('id')
            ->paginate();

        return response()
            ->json([
                'status' => true,
                'data' => $users
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function getDoctorRoleAllUser(): JsonResponse
    {
        $doctors = User::query()
            ->where('role_id', '=', 1)
            ->orderByDesc('id')
            ->get();
        return response()
            ->json([
                'status' => true,
                'data' => $doctors
            ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['login', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Your password is incorrect'
            ]);
        } else {
            $token = $request->user()->createToken($request->user()->name);
            $data = [
                '_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse()->toDateTimeString(),
                'user_id' => $request->user()->id,
                'role_id' => $request->user()->role_id,
                'role' => $request->user()->role->title
            ];
            return response()->json([
                $data
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required',
                'login' => 'required|string|unique:users,login',
                'password' => 'required|confirmed',
                'role_id' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->login = $request->login;
            $user->password = bcrypt($request->password);
            $user->role_id = $request->role_id;
            $user->save();
//            Auth::guard()->login($user);

            return response()
                ->json([
                    'status' => true,
                    'message' => 'User updated successfully.',
                    'data' => $user
                ]);
        } catch (Exception $exception) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $exception->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()
            ->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ]);
    }
}
