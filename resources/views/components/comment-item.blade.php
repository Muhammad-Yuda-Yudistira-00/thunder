<div class="flex items-start gap-2.5 mt-2">
    <img class="w-8 h-8 rounded-full" src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('img/user-3.png') }}" alt="User image">
    <div class="flex flex-col w-full leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $comment->updated_at->diffForHumans() }}</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{!! $comment->comment_text !!}</p>
    </div>
</div>

@if($comment->children->isNotEmpty())
    <ul class="ml-12 mt-4 border-l-2 pl-4 dark:border-slate-600">
        @foreach($comment->children as $child)
            <x-comment-item :comment="$child" />
        @endforeach
    </ul>
@endif
