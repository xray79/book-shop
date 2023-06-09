@props(['editUrl', 'users'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-4/5 mx-auto mt-20">
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    id
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
            @foreach ($users as $user) 
                <tr class="border-b bg-gray-900 border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-normal text-white">
                        <a href="/users/{{$user->id}}" class="hover:underline">
                            {{ $user->email }}
                        </a>
                    </th>
                    <td class="px-6 py-4">
                        <a href="/users/{{$user->id}}" class="hover:underline">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->id }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/admin/users/{{$user->id}}/edit" class="font-medium text-blue-500 hover:text-blue-700 hover:underline">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>