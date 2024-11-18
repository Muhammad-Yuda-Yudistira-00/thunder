@php
  // dd($post->comments);
@endphp

<!-- Main modal -->
<div
  id="comment-modal-{{ $post->id }}"
  tabindex="-1"
  aria-hidden="true"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
  <div class="relative p-4 w-full max-w-3xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div
        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
      >
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
          Post: {{ $post->user->name }}
        </h3>
        <button
          type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="comment-modal-{{ $post->id }}"
        >
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
            />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5 space-y-4 dark:text-slate-300">
        {!! $post->body !!}
      </div>
      <!-- Modal footer -->
      <div
        class="flex flex-col items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 w-full"
      >
        <form
          action="{{ route("comments.store", ["post_id" => $post->id]) }}"
          method="POST"
        >
          @csrf
          @method("POST")
          @trix(\App\Post::class, "body")
          <div class="mt-4 text-right">
            <x-general.button type="submit">Comment</x-general.button>
          </div>
        </form>

        @php
        $parentComments = $post->comments->whereNull('parent_comment_id');
        @endphp

        @if($parentComments->isNotEmpty())
            <x-general.chat-bubble-comment :comments="$parentComments"></x-general.chat-bubble-comment>
        @else
            <h3 class="text-4xl py-12 dark:text-slate-100 font-extralight opacity-30 text-center">Comment not found!</h3>
        @endif

      </div>
    </div>
  </div>
</div>
