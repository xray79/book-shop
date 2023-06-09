@props(['categories'])

<form 
    action="/upload" 
    method="POST" 
    enctype="multipart/form-data"
    class="flex flex-col space-y-4 max-w-xs md:max-w-md mx-auto my-22">
    @csrf

    <x-form.text-input name="title" />
    <x-form.text-input name="description" />

    {{-- Category dropdown --}}
    <div class="py-2">
        <p class="block mb-2 text-sm font-medium text-black">Choose a category</p>

        <x-form.category-select>
            @foreach ($categories as $category)
                <option name="category_id" value="{{$category->id}}">
                    {{ $category->name }}
                </option>    
            @endforeach
        </x-form.category-select>
    </div>

    <x-form.file-input name="thumbnail" />
    <x-form.file-input name="PDF" />

    <div>
        <x-form.submit class="mt-8 mr-2 mb-2" />
    </div>

</form>