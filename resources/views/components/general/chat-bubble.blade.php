@php
  // dd($posts[1]->comments[0]->user);
@endphp

@foreach($posts as $post)
  <div class="flex items-start gap-2.5 mb-4">
     <x-micro.profile-picture :profilePicture="$post->user->profile_picture" class="w-10 h-10"></x-micro>
     <div class="flex flex-col w-[620px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
           <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</span>
           <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $post->updated_at->diffForHumans() }}</span>
        </div>
        <div class="dark:text-gray-300">
         {!! $post->body !!}
        </div>
        <div class="flex justify-around items-center">
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400 flex gap-2">
            @if($post->liked())
            <form action="{{ route('posts.unlike', ['post_id' => $post->id]) }}" method="POST">
              @csrf
              <button type="submit" class="">
                <x-icons.thumb-full></x-icons>
              </button>
              <small class="font-bold">
                {{ $post->likeCount }}
              </small>
            </form>
            @else
            <form action="{{ route('posts.like', ['post_id' => $post->id]) }}" method="POST">
              @csrf
              <button type="submit" class="">
                <x-icons.thumb></x-icons>
              </button>
              <small class="font-bold">
                {{ $post->likeCount }}
              </small>
            </form>
            @endif
          </span>
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400 flex gap-2">
            @php
              $userComment = $post->comments->firstWhere('user.id', auth()->user()->id);
            @endphp
            <button type="button" data-modal-target="comment-modal-{{ $post->id }}" data-modal-toggle="comment-modal-{{ $post->id }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">
              @if($userComment)
                <span class="inline-block">
                  <x-icons.message-fill></x-icons.message-fill>
                </span>
              @else
                <span class="inline-block">
                  <x-icons.message></x-icons.message>
                </span>
              @endif
              <small class="font-bold">
                  {{ $post->comments->count() }}
              </small>
            </button>
          </span>
        </div>
     </div>
     <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdown{{ $post->id }}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
           <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
        </svg>
     </button>
     <div id="dropdown{{ $post->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
           <li>
              <button type="button" data-modal-target="comment-modal-{{ $post->id }}" data-modal-toggle="comment-modal-{{ $post->id }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">Comment</button>
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
<x-post.comment-modal :$post></x-post>
@endforeach

