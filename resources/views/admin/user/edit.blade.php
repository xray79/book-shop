<x-layout>
    <h1 class="text-center my-8">Edit {{$user->name}}'s account</h1>

    <a href="/admin/users" class="hover:underline ml-16">Back to all users</a>

    <form 
        action="/admin/users/{{$user->id}}" 
        method="POST" 
        class="max-w-lg mx-auto my-8">
            @csrf
            @method('PATCH')

            <x-form.text-input name="user full name" value="{{ $user->name }}" class="my-3" />

            <x-form.text-input name="email" value="{{ $user->email }}" class="my-3" />

            <div class="mb-6">
                <label 
                    for="password" 
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >User Password
                </label>

                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Update password">
            </div>

            <x-form.submit />
    </form>
</x-layout>