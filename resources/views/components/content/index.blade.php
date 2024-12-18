@php
  // dd($posts[0]->user);
  // dd($bookmarks);
@endphp

<div class="border-b-2 border-gray-600 mb-4">
  <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal" class="max-w-2xl w-full mx-auto block">
		<input type="hidden" name="room_id" value="{{ $roomId }}">
    <div class="mb-5">
  	  <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
  	  <textarea id="message" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
    </div>
  </button>
</div>

<div class="max-w-2xl mx-auto flex flex-col items-center">
  @if(count($posts) > 0)
    <x-general.chat-bubble :$posts :$active :$bookmarks></x-general.chat-bubble>
  @else
    <div class="h-60 flex justify-center items-center">
      <h1 class="text-4xl dark:text-gray-300">Not Found: Posts</h1>
    </div>
  @endif
</div>

{{ $posts->links() }}

<x-general.modal :$active modal="post"></x-general.modal>
