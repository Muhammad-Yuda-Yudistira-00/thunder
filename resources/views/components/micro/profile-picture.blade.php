<img {{ $attributes->merge(['class' => 'rounded-full']) }} src="{{ $profilePicture ? asset('storage/' . auth()->user()->profile_picture) : asset('img/user-3.png') }}" alt="Profile Picture">
