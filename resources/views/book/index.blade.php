<x-layout>
    <section class="bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80')] bg-gray-700 bg-blend-multiply min-h-fit">

        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Book Shop
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                Find a book
            </p>

            <x-search-input />

            <div class="mt-10 flex mx-auto items-center justify-center gap-6">
                <x-dropdown>
                    <x-slot name="header">Choose a category</x-slot>
                    <x-slot name="list">
                        @foreach ($categories as $category)
                            <li class="hover:bg-blue-800">
                                <a href="/categories/{{$category->id}}" class="my-3 hover:underline">
                                    {{$category->name}}
                                </a>
                            </li>
                        @endforeach
                    </x-slot>
                </x-dropdown>

                <x-dropdown>
                    <x-slot name="header">Choose an author</x-slot>
                    <x-slot name="list">
                        @foreach ($users as $user)
                            <li class="hover:bg-blue-800 my-3">
                                <a href="/users/{{$user->id}}" class="my-3 hover:underline">{{$user->name}}
                                </a>
                            </li>
                        @endforeach
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold mb-2 mt-12 w-2/3 mx-auto">
            Available books
        </h2>

        <div class="flex flex-col items-center space-y-4 my-8 w-2/3 mx-auto">
            @foreach ($books as $book)
                <x-card :book="$book" />
            @endforeach
        </div>

        <div class="flex justify-end w-2/3 mx-auto my-10">
            {{ $books->links() }}
        </div>
    </section> 
</x-layout>