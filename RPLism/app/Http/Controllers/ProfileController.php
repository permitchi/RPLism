<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'phone_num' => ['required', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Update user data using User model
        User::where('id', $user->id)->update([
            'username' => $request->username,
            'phone_num' => $request->phone_num,
        ]);

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            // You can implement file storage logic here
            // For now, we'll just validate that the file was uploaded
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
