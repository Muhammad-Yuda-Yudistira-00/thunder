@php
  // dd($comment);
@endphp

<ul class="border-t-2 w-full mt-8 dark:border-slate-300">
@foreach($comments as $comment)
  <div class="flex items-start gap-2.5 first:mt-8 mt-2">
     <img class="w-8 h-8 rounded-full" src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('img/user-3.png') }}" alt="Jese image">
     <div class="flex flex-col w-full leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
           <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
           <span class="text-sm font-normal text-gray-500 dark:text-gray-400"></span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{!! $comment->comment_text !!}</p>
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $comment->updated_at->diffForHumans() }}</span>
     </div>
     <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownComment{{ $comment->id }}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
           <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
        </svg>
     </button>
     <div id="dropdownComment{{ $comment->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
           <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
           </li>
           <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
           </li>
           <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
           </li>
           <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
           </li>
           <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
           </li>
        </ul>
     </div>
  </div>
@endforeach
</ul>