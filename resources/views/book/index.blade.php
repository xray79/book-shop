<x-layout>
    {{-- recieve json data from backend and present as alpine dropdown (php to js) --}}
    <script> const users = {!! $usersJson !!}; </script>

    <section class="bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80')] bg-gray-700 bg-blend-multiply min-h-fit h-screen bg-cover">

        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Book Shop
            </h1>

            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                Find a book
            </p>

            <x-search-input />

            <div class="mt-10 flex mx-auto items-center justify-center gap-6">
                {{-- Category dropdown --}}
                <x-dropdown>
                    <x-slot name="header">
                        Choose a category ↓
                    </x-slot>
                    
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

                {{-- Author dropdown --}}
                <x-dropdown>
                    <x-slot name="header">
                        Choose an author ↓
                    </x-slot>

                    <x-slot name="list">
                        <div x-cloak x-data="{
                            search: '',
                            users: users,
                            
                            get filteredUsers() {
                                return this.users.filter(
                                    user => user.name.toLowerCase().includes(
                                        this.search.toLowerCase()
                                    )
                                )
                            }
                        }">
                            <input 
                                type="text" 
                                placeholder="Search Authors" 
                                x-model="search" 
                                class="block w-full text-black text-center rounded-xl">
                            <template x-for="user in filteredUsers" :key="user.id">
                                <ul>
                                    <a 
                                    :href="`/users/${user.id}`" 
                                    x-text="user.name"
                                    class="block my-2 hover:underline hover:bg-blue-700"></a>
                                </ul>
                            </template>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </section>

    <section id="results">
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