<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return response()->json($profile);
    }

    public function generateMultiple(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1|max:1000',
            'password' => 'required|string',
        ]);

        if ($request->password !== '12345678') {
            return response()->json(['message' => 'wrong password'], 401);
        }

        $count = $request->count;
        $profiles = [];

        for ($i = 0; $i < $count; $i++) {
            $profiles[] = Profile::create([
                'links' => []
            ]);
        }

        return response()->json($profiles);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);


        if ($profile->isActive == true) {
            if (Hash::check($request->password, $profile->password)) {
                $request->validate([
                    'fullName' => 'sometimes|string',
                    'password' => 'required|string',
                    'newPassword' => 'sometimes|string',
                    'email' => 'nullable|email',
                    'address' => 'nullable|string',
                    'avatar' => 'nullable|string',
                    'phone' => 'nullable|string',
                    'links' => 'nullable|array',
                ]);
                // do a normal update
                $profile->update([
                    'fullName' => $request->fullName,
                    'email' => $request->email,
                    'links' => $request->links,
                    'phone' => $request->phone,
                    'avatar' => $request->avatar,
                    'address' => $request->address,
                ]);
                if ($request->newPassword) {
                    $profile->update([
                        'password' => $request->newPassword,
                    ]);
                }
            } else {
                return response()->json(['message' => 'wrong password'], 401);
            }
        } else {
            $request->validate([
                'fullName' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|email',
                'phone' => 'nullable|string',
                'links' => 'nullable|array',
                'address' => 'nullable|string',
                'avatar' => 'nullable|string',
            ]);
            // dd($profile);
            // activate the profile
            $profile->update([...$request->all(), 'isActive' => true]);
        }

        return response()->json($profile);
    }


    public function checkPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        $profile = Profile::findOrFail($id);

        if ($profile->isActive == true) {
            if (Hash::check($request->password, $profile->password)) {
                return response()->json([
                    'checkPassword' => true
                ]);
            } else {
                return response()->json(['message' => 'wrong password'], 401);
            }
        }
    }
}
