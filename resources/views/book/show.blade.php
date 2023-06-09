@php
    use App\Helpers\Helpers;
    if (Auth::check()) {
        $mappedId = Helpers::mapId(Auth::user()->id);
    }
@endphp

<x-layout>
    <section class="container mx-auto">
        <a 
            href="/" 
            class="inline-block text-black bg-transparent focus:outline-none border-2 border-blue-300 hover:border-transparent hover:text-white font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-8 hover:bg-blue-700 focus:ring-blue-800"
            >Back to all books
        </a>

        <h1 class="text-center text-2xl my-7">
            {{ $book->title }}
        </h1>

        <div class="flex justify-between items-center w-2/3 mx-auto">
            <a 
                href="/users/{{$book->user_id}}"
                class="hover:underline"
                >Author: {{ $book->user->name }}
            </a>
            <a
                href="/categories/{{ $book->category_id }}" 
                class="text-black bg-transparent focus:outline-none border-2 border-blue-300 hover:border-transparent hover:text-white font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 hover:bg-blue-700 focus:ring-blue-800"
                >{{ $book->category->name }}
            </a>
        </div>

        <div class="w-2/3 mx-auto my-8 mb-20">
            <x-single-book-card :book="$book" />

            @if (Auth::check())
                <x-comment-box :book_id="$book->id"/>
            @else
                <div class="text-center my-12 font-semibold">
                    <a href="/log-in" class="hover:underline">
                        Log in to post a comment
                    </a>
                </div>
            @endif

            @foreach ($book->comment as $comment)
                <x-comment-post :comment="$comment" />
            @endforeach
        </div>
    </section>
</x-layout>