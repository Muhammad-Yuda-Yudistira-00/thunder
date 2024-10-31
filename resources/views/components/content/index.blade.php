@php
  // dd($posts[0]->user);
@endphp

<div class="border-b-2 border-gray-600 mb-4">
	
	<form class="max-w-2xl mx-auto" method="POST" action="{{ route('post.store') }}">
		@csrf
		<input type="hidden" name="category" value="{{ $active }}">
	  <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
	  <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
	  <div class="mt-2 text-right">
	  	<button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Post</button>
	  </div>
	</form>

</div>

<div class="max-w-2xl mx-auto flex flex-col items-center">
  @if(count($posts) > 0)
    <x-general.chat-bubble :$posts></x-general>
  @else
    <div class="h-60 flex justify-center items-center">
      <h1 class="text-4xl dark:text-gray-300">Not Found: Posts</h1>
    </div>
  @endif
</div>
