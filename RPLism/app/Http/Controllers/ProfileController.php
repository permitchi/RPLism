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
            'address' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Update user data using User model
        User::where('id', $user->id)->update([
            'username' => $request->username,
            'phone_num' => $request->phone_num,
            'address' => $request->address,
        ]);


        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imagePath = $image->store('profile_pictures', 'public');
            // Save the image path to the user (column: pfp_image)
            $user->pfp_image = $imagePath;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
