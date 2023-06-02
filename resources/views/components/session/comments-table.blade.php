@props(['comments'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-4/5 mx-auto mt-20">
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Comment
                </th>
                <th scope="col" class="px-6 py-3">
                    Book
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
            @foreach ($comments as $comment) 
                <tr class="border-b bg-gray-900 border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-normal text-white">
                            {{ $comment->id }}
                    </th>
                    <td class="px-6 py-4">
                        <a class="hover:underline" href="/users/{{ $comment->user->id }}">
                            {{ $comment->user->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                            {{ $comment->text }}
                    </td>
                    <td class="px-6 py-4">
                        <a class="hover:underline" href="/book/{{ $comment->book->id }}">
                            {{ $comment->book->title }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a 
                            href="/my-account/comments/{{ $comment->id }}/edit" 
                            class="font-medium text-blue-500 hover:underline"
                            >Edit
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="/my-account/comments/{{ $comment->id }}" method="post">
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