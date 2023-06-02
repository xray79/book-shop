@props(['books'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-4/5 mx-auto mt-20">
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Author
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit action
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete action
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
                    <td class="px-6 py-4">
                        <a href="/my-account/books/{{ $book->id }}/edit" class="font-medium text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="/my-account/books/{{ $book->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="font-medium text-gray-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>