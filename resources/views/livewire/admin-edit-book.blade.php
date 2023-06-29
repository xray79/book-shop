<div>
    <div class="flex w-full items-start pl-4">
        <button
        class="rounded-full py-1 px-3 text-sm border border-black hover:border-blue-400 hover:text-white hover:bg-blue-400 transition-all ease-in-out"
        wire:click="emitToggleEditFormEvent"
        >
        Back
        </button>
    </div>

    <form 
        action="/admin/books/{{$book->id}}" 
        wire:submit.prevent="submitHandler"
        method="POST" 
        class="max-w-lg mx-auto my-8" 
        enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.text-input 
            name="book title"
            wire:model="title" 
            class="mb-6" />

            @error('title') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- Author dropdown --}}
            <div class="mb-6">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-900">
                    Author
                </label>
                
                <x-form.category-select 
                    name='user_id' 
                    wire:model="selectedUserId">
                        @foreach ($users as $user)
                            <option 
                                value="{{$user->id}}"
                                {{$book->user->name == $user->name ? 'selected' : ''}}
                                required>
                                {{$user->name}}
                            </option>    
                        @endforeach
                </x-form.category-select>
            </div>

            @error('selectedUserId') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- Category dropdown --}}
            <div class="mb-6">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                    Category
                </label>
                
                <x-form.category-select 
                    name='category_id' 
                    wire:model="selectedCategoryId">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                {{$book->category->name == $category->name ? 'selected' : ''}}
                                required>
                                {{$category->name}}
                            </option>    
                        @endforeach
                </x-form.category-select>
            </div>

            @error('selectedCategoryId') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <x-form.file-input 
                label="Book thumbnail" 
                name="thumbnail" 
                wire:model="thumbnail" 
                class="mb-8" />

            @error('thumbnail') 
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- Book description --}}
            <div class="mb-6 h-40">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                    Description
                </label>
                
                <textarea 
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="description"
                    name="description"
                    rows="5"
                    required
                    wire:model="description">
                </textarea>
            </div>

            @error('description') 
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <x-form.submit />
        </form>

        
</div>
