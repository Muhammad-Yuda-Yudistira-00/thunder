<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-64 uppercase">
            {{ __($active) }}
        </h2>
    </x-slot>

<x-user.navigation2></x-user.navigation2>

<x-user.aside :active="$active" :rooms="$rooms"></x-user>


<div class="p-4 sm:ml-64">
    @if(session('success'))
        <x-general.alert>{{ session('success') }}</x-general>
    @elseif(session('failed'))
        <x-general.alert status="error" color="red">{{ session('failed') }}</x-general>
    @endif
    <form action="#" method="POST">
        @method('PUT')
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choosen a user</label>
                <select id="user" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option selected>Choosen a user</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
            </div>
            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change a role</label>
                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option selected>Change a role</option>
                  @foreach($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
    </form>
  </div>

</div>

</x-app-layout>
