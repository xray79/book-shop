@props(['comment'])

@php
    use App\Helpers\Helpers;
    $mapped_id = Helpers::mapId($comment->user_id);
@endphp

<article class="border-2 border-gray-200 rounded p-3 flex space-x-5 my-6">

    <div class="flex-initial w-60">
        <div class="flex items-center mb-4 space-x-4">
            <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?img={{$mapped_id}}" alt="Profile picture">
            <div class="space-y-1 font-medium text-white">
                <p class="block text-black text-sm">
                    <a href="/users/{{$comment->user_id}}" class="hover:underline">{{ $comment->user->name }}</a>
                </p>
            </div>
        </div>
        
        <footer class="mb-5 text-sm text-gray-400">
            <p>Posted 
                <time>{{ $comment->created_at->diffForHumans() }}</time>
            </p>
        </footer>
    </div>

    <p class="mb-2 p-5 text-gray-400 flex-1">{{ $comment->text }}</p>
  
</article>
