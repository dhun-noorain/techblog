<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if ($request->user()->social != null || $request->user()->social != "") {
            $request->user()->social = join(',',
                json_decode($request->user()->social)
            );
        }

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // show user (blog admin) info to the public
    public function show(Request $request): View
    {
        $user = User::select('id', 'name', 'email', 'picture', 'bio', 'social')
            ->where('id', $request->user)
            ->get()[0];

        return view('profile.show', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $old = User::select('picture')
            ->where('id', $request->user()->id)
            ->get()[0]['picture'];

        $post = $request->validated();

        if (key_exists('picture', $post)) {
            $image = $post['picture'];
            $imageName = $post['name'] . $request->user()->id . '.' . $image->extension();
            $validated['picture'] = $imageName;
        }

        $validated['name'] = $post['name'];
        $validated['email'] = $post['email'];
        $validated['bio'] = $post['bio'];
        $validated['social'] = json_encode(
            array_filter(explode(',', trim($request->social)))
        );

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if (key_exists('picture', $post) && !empty($old)) {
            if (Storage::delete('/userImg/' . $old)) {
                if (Storage::putFileAs('userImg', $image, $imageName)) {
                    $request->user()->save();
                }
            }
        } else {
            if (Storage::putFileAs('userImg', $image, $imageName)) {
                $request->user()->save();
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
