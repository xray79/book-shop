@props(['book'])

<a 
    href="/book/{{ $book->id }}" 
    {{ $attributes(['class' => 'flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full']) }}>
        <img 
            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
            src="{{ asset('storage/' . $book->thumbnail) }}" 
            alt="">

        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                {{ $book->title }}
            </h5>
            <h6 class="mb-2 text-md font-semibold tracking-tight text-gray-400 ">
                {{ $book->user->name }}
            </h6>
            <h6 class="mb-2 text-md font-semibold tracking-tight text-gray-300 ">
                {{ $book->category->name }}
            </h6>
            <p class="mb-2 tracking-tight text-gray-300">
                {{ $book->created_at->diffForHumans() }}
            </p>
            <p class="mb-3 font-normal text-gray-300">
                {{ $book->description }}
            </p>
        </div>
</a>
