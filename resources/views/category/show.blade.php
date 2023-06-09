<x-layout>
    <section class="min-h-screen py-20">
        <h1 class="text-center text-4xl font-extrabold capitalize my-5">
            Books in {{ $category->name }} category
        </h1>

        {{-- <x-search-input class="my-12" /> --}}
        
        <div class="w-2/3 mx-auto">
            @foreach ($books as $book)
                <x-card :book="$book" class="my-4" />
            @endforeach
        </div>
    </section>
</x-layout>