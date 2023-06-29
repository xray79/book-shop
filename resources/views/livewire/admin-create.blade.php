<form 
    {{-- action="/admin/books"  --}}
    method="POST" 
    class="flex flex-col space-y-4 max-w-xs md:max-w-md mx-auto mt-10"
    enctype="multipart/form-data"
    wire:submit.prevent="submitHandler"
    >
    @csrf

    <div class="flex items-start">
        <button
        class="rounded-full py-1 px-3 text-sm border border-black hover:border-blue-400 hover:text-white hover:bg-blue-400 transition-all ease-in-out"
        wire:click="emitToggleCreateFormEvent"
        >
            Back
        </button>
    </div>

    {{-- Author dropdown --}}
    <div class="mb-6">
        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 ">Author</label>
        <x-form.category-select 
            name='user_id'
            wire:model="selectedUserId">
            @foreach ($users as $user)
                <option 
                    value="{{$user->id}}"
                    required
                    >{{$user->name}}
                </option>    
            @endforeach
        </x-form.category-select>
    </div>

    {{-- Category dropdown --}}
    <div class="mb-6">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
        <x-form.category-select 
            name="category_id"
            wire:model="selectedCategoryId">
            @foreach ($categories as $category)
                <option 
                    value="{{$category->id}}"
                    required
                    >{{$category->name}}
                </option>    
            @endforeach
        </x-form.category-select>
    </div>

    <x-form.text-input wire:model="title" name="title" />
    <x-form.text-input wire:model="description" name="description" />

    <x-form.file-input wire:model="thumbnail" name="thumbnail" />    
    <x-form.file-input wire:model="pdf" name="PDF" />

    <div>
        <x-form.submit  class="block mt-8 mr-2 mb-2" />
    </div>

</form>
