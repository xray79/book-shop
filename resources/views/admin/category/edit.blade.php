<x-layout>
    <h1 class="text-center my-8">
        Edit {{ $category->name }} category
    </h1>

    <a href="/admin/categories/" class="hover:underline ml-16">
        Back to all categories
    </a>

    <form 
        action="/admin/categories/{{ $category->id }}" 
        method="POST"
        class="max-w-lg min-h-screen mx-auto my-8">
        @csrf
        @method('PATCH')

        <x-form.text-input name="category" :value="$category->name" />
        
        <x-form.submit class="mt-6" />
    </form>
</x-layout>