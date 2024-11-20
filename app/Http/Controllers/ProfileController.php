<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     // upload process here
    //     if ($request->hasFile('profile_picture')) {
    //         if ($request->user()->profile_picture) {
    //             Storage::delete($request->user()->profile_picture);
    //         }

    //         $path = $request->file('profile_picture')->store('profile_pictures', 'public');
    //         $request->user()->profile_picture = $path;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function updateProfileInfo(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Reset email verification jika email diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-info-updated');
    }

    public function updateProfilePicture(Request $request)
    {
        // Validasi Base64 image dari frontend
        $request->validate([
            'cropped_image' => 'required|string', // Pastikan gambar Base64 ada
        ]);

        $user = $request->user();

        // Hapus gambar lama jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Ambil gambar yang di-crop dari request
        $croppedImage = $request->input('cropped_image');

        // Proses Base64 image menjadi gambar
        // Mengambil konten gambar dari string Base64
        $imageData = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $croppedImage));

        // Buat instance ImageManager
        $manager = new ImageManager(new Driver());

        // Simpan file gambar yang telah didecode ke storage
        $filename = 'profile_pictures/' . uniqid() . '.jpg'; // Gunakan nama unik untuk file
        Storage::disk('public')->put($filename, $imageData);

        // Simpan path ke database
        $user->profile_picture = $filename;
        $user->save();

        // Redirect kembali ke halaman profil dengan status
        return Redirect::route('profile.edit')->with('status', 'profile-picture-updated');
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
