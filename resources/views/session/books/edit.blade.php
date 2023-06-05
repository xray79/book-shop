<x-layout>
    <a href="/my-account/books" 
    class="m-5 p-3 rounded-2xl border-blue-500 border inline-block hover:bg-blue-500 hover:border-white hover:text-white"
    >Back to my books</a>

    <h1 class="text-center my-8 font-bold">Edit {{$book->title}}</h1>

    <form 
        action="/my-account/books/{{$book->id}}" 
        method="POST" 
        class="max-w-lg mx-auto my-8" 
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <x-form.text-input name="Book Title" />
        {{-- <div class="mb-6">
            <label 
                for="title" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Book Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                value="{{$book->title}}" 
                required>
        </div> --}}

        {{-- Category dropdown --}}
        <div class="mb-6">
            <label 
                for="category" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Category
            </label>
            
            <x-form.category-select name='category_id'>
                @foreach ($categories as $category)
                    <option 
                        value="{{$category->id}}"
                        {{$book->category->name == $category->name ? 'selected' : ''}}
                        required
                        >{{$category->name}}
                    </option>    
                @endforeach
            </x-form.category-select>
        </div>

        <div class="flex flex-col mb-8">
            <x-form.file-input label="Book thumbnail" name="thumbnail" />
        </div>

        <div class="mb-6 h-40">
            <label 
                for="description" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Description
            </label>

            <textarea 
                id="description"
                name="description"
                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                rows="5"
                required
                >{{$book->description}}
            </textarea>
        </div>

        <x-form.submit />
    </form>
</x-layout>