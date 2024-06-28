<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangeAvatarRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangePhoneNumberRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function delete()
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found'], 400);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found'], 400);
        }
        return UserResource::collection($users);
    }
    public function updateName(UpdateUserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->update($request->validated());

        return response()->json([
            'message' => 'User updated successfully',
            'user' => new UserResource($user)
        ], 200);
    }
    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully'], 200);
    }
    public function updatePhone(ChangePhoneNumberRequest $request)
    {
        $user = User::find(Auth::id());
        $user->phone_number = '+2' . $request->phone_number;
        $user->save();

        return response()->json(['message' => 'Phone number updated successfully', 'user' => new UserResource($user)], 200);
    }
    public function show()
    {
        $user = User::find(Auth::id());
        return response()->json(new UserResource($user));
    }
    public function updateAvatar(ChangeAvatarRequest $request)
    {
        $user = User::find(auth()->id());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            if ($user->avatar && File::exists(public_path($user->avatar))) {
                File::delete(public_path($user->avatar));
            }

            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $request->file('avatar')->move(public_path('images/avatars'), $fileName);

            $user->avatar = 'images/avatars/' . $fileName;
            $user->save();
        }

        return response()->json(['message' => 'Avatar updated successfully', 'user' => new UserResource($user)], 200);
    }
}
