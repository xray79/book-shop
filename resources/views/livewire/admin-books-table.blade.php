<div>
    <table class="w-full text-sm  text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <button 
                        wire:click="sortBy('title')"
                        class="uppercase"
                        >Title <span>{{ $sortField === 'title' ? ($sortAsc ? '↓' : '↑') : ''}}</span> 
                    </button>
                </th>
                <th scope="col" class="px-6 py-3">
                    <button 
                    wire:click="sortBy('user_id')"
                    class="uppercase"
                    >Author <span>{{ $sortField === 'user_id' ? ($sortAsc ? '↓' : '↑') : ''}}</span>
                    </button>
                </th>
                <th scope="col" class="px-6 py-3">
                    <button 
                    wire:click="sortBy('category_id')"
                    class="uppercase"
                    >
                    Category <span>{{ $sortField === 'category_id' ? ($sortAsc ? '↓' : '↑') : ''}}</span>
                    </button>
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($books as $book) 
                <tr class="border-b bg-gray-900 border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-normal text-white">
                        <a class="hover:underline" href="/book/{{$book->id}}">
                            {{ $book->title }}
                        </a>
                    </th>
                    <td class="px-6 py-4">
                        <a class="hover:underline" href="/users/{{$book->user_id}}">
                            {{ $book->user->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a class="hover:underline" href="/categories/{{$book->category_id}}">
                            {{ $book->category->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->description }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button 
                            wire:click="toggleEditFormHandler({{ $book }})"
                            class="font-medium text-blue-500 hover:text-blue-700">   
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button
                            wire:click="toggleDeleteFormHandler({{ $book }})"
                            class="font-medium text-gray-500 hover:text-gray-700 hover:underline" 
                            ><i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="flex justify-end my-8 mr-5">
        {{ $books->links() }}
    </div>
</div>