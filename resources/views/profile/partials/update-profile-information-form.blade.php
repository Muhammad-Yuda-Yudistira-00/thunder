<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

   {{-- <form method="post" action="{{ route('profile.picture.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data" id="profile-picture-form">
    @csrf
    @method('patch')

    <div>
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_picture">Change Profile Picture</label>
      <span class="my-4 w-24 h-24 my-4 block ml-4">
        <x-micro.profile-picture :profilePicture="auth()->user()->profile_picture" name="{{ auth()->user()->name }}" class="w-full h-full"></x-micro>
      </span>
      <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="profile_picture"
        type="file"
        name="profile_picture"
      >
      <div class="mt-4">
        <x-primary-button>{{ __('upload & crop') }}</x-primary-button>
      </div>

    </div>
  </form> --}}

  <form method="post" action="{{ route('profile.picture.update') }}" class="mt-6 space-y-6" id="profile-picture-form">
    @csrf
    @method('patch')

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_picture">
            Change Profile Picture
        </label>
        <span class="my-4 w-24 h-24 my-4 block ml-4">
            <x-micro.profile-picture :profilePicture="auth()->user()->profile_picture" name="{{ auth()->user()->name }}" class="w-full h-full"></x-micro>
        </span>

        <!-- Trigger untuk membuka Modal -->
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="profile_picture"
            type="file"
            name="profile_picture"
            accept="image/*"
            data-modal-toggle="profile-picture-modal"
        >

        {{-- <!-- Area preview gambar yang akan di-crop -->
        <div id="image-preview-container" class="mt-4 hidden">
            <img id="image-to-crop" style="max-width: 100%; max-height: 400px;" />
        </div>

        <!-- Tombol untuk upload dan crop -->
        <div class="mt-4">
            <x-primary-button id="crop-and-upload-button" type="button" disabled>{{ __('Upload & Crop') }}</x-primary-button>
        </div> --}}

        <x-profile.modal-profile-picture></x-profile.modal-profile-picture>
    </div>
</form>



    <form method="post" action="{{ route('profile.info.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_picture">Change Profile Picture</label>
          <span class="my-4 w-24 h-24 my-4 block ml-4">
            <x-micro.profile-picture :profilePicture="auth()->user()->profile_picture" name="{{ auth()->user()->name }}" class="w-full h-full"></x-micro>
          </span>
          <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="profile_picture" type="file" name="profile_picture">
        </div> --}}


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
