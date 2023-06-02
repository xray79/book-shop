<x-layout>
    <section class="min-h-screen py-20">
        <h1 
            class="text-center text-4xl font-extrabold capitalize my-4"
            >{{ $user->name }}'s Books
        </h1>
        
        <div class="w-2/3 mx-auto mt-3">
            @foreach ($books as $book)
                <x-card :book="$book" class="my-4" />
            @endforeach
        </div>
    </section>
</x-layout>