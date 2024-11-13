@php
    // dd($active);
    // PR: penggabungan class untuk active menu
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        @foreach($rooms as $room)
        <li>
            <x-user.aside-item href="{{ route('dashboard.show', ['slug' => $room->slug]) }}" class="{{ $active == $room->slug ? 'dark:text-blue-800 text-blue-800' : '' }}">{{ $room->name }}</x-user>
         </li>
         @endforeach
      </ul>
   </div>
</aside>
