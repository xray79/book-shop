@props(['book'])

<div class="py-4 flex flex-col items-center border rounded-lg shadow md:flex-row border-gray-700 bg-gray-800 w-full">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('storage/' . $book->thumbnail) }}" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal w-full h-full">
        <p class="mb-3 font-semibold text-gray-400">Description:</p>
        <p class="mb-3 font-normal text-gray-300">{{ $book->description }}</p>

        @if (Auth::check())
            <div>
                <a 
                href="/book/download/{{ $book->id }}" 
                class="border focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center border-blue-500 text-blue-500 hover:text-white hover:bg-blue-500 focus:ring-blue-800">Download</a>
            </div>
        @else
            <div class="my-5">
                <a href="/log-in" class="inline py-2 px-3 text-white hover:bg-gray-400 hover:text-black font-semibold border rounded">Log in to download</a>
            </div>
        @endif
    </div>
</div>



{{-- https://images.pexels.com/photos/11042709/pexels-photo-11042709.jpeg --}}