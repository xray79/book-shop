@props(['categories'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-4/5 mx-auto mt-20">
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Total books
                </th>
                <th scope="col" class="px-6 py-3">
                    Category ID
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
            @foreach ($categories as $category) 
                <tr class="border-b bg-gray-900 border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-normal text-white">
                        <a href="/categories/{{$category->id}}" class="hover:underline">
                            {{ $category->name }}
                        </a>
                    </th>
                    <td class="px-6 py-4">
                        {{ $category->book->count() }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $category->id }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/admin/categories/{{$category->id}}/edit" class="font-medium text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="/admin/categories/{{$category->id}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="font-medium text-gray-500 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>