<form 
    action="/admin/books" 
    method="POST" 
    class="flex flex-col space-y-4 max-w-xs md:max-w-md mx-auto mt-10"
    enctype="multipart/form-data">
    @csrf

            <div class="mb-6">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 ">Author</label>
                
                <x-form.category-select name='user_id'>
                    @foreach ($users as $user)
                        <option 
                            value="{{$user->id}}"
                            required
                            >{{$user->name}}
                        </option>    
                    @endforeach
                </x-form.category-select>
            </div>

            <div class="mb-6">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                
                <x-form.category-select name='category_id'>
                    @foreach ($categories as $category)
                        <option 
                            value="{{$category->id}}"
                            required
                            >{{$category->name}}
                        </option>    
                    @endforeach
                </x-form.category-select>
            </div>

    <x-form.text-input name="title" />

    <x-form.text-input name="description" />

    <x-form.file-input name="thumbnail" />
    
    <x-form.file-input name="PDF" />

    <div>
        <x-form.submit class="mt-8 mr-2 mb-2" />
    </div>

</form>