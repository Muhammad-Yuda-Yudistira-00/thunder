@php
    // dd($rooms);
    // dd($active);
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-64 uppercase">
            {{ __('Room') . " " . $active }}
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

   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <x-content :$active :$posts :$roomId></x-content>
   </div>

</div>

</x-app-layout>
