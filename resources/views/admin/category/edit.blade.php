<x-layout>
    <h1 class="text-center my-8">Edit {{ $category->name }} category</h1>

    <form 
        action="/admin/categories/{{ $category->id }}" 
        method="POST" 
        class="max-w-lg min-h-screen mx-auto my-8">
        @csrf
        @method('PATCH')

        <x-form.text-input name="category" placeholder="{{$category->name}}" />
        
        <x-form.submit class="mt-6" />
    </form>
</x-layout>