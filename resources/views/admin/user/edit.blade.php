<x-layout>
    <h1 class="text-center my-8">
        Edit {{$user->name}}'s account
    </h1>

    <a href="/admin/users" class="hover:underline ml-16">
        Back to all users
    </a>

    <form 
        action="/admin/users/{{$user->id}}" 
        method="POST" 
        class="max-w-lg mx-auto my-8">
            @csrf
            @method('PATCH')

            <x-form.text-input name="user full name" :value="$user->name" class="my-3" />

            <x-form.text-input name="email" :value="$user->email" class="my-3" />

            <x-form.text-input name="password" type="password" placeholder="Update Password" class="my-3" />

            <x-form.text-input name="confirm password" type="password" placeholder="Confirm Password" class="my-3" />

            <x-form.submit />
    </form>
</x-layout>