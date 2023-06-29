<div>
    <x-admin.livewire-search
        class="my-5"    
        wire:model="search"
    />

    <div class="relative overflow-x-auto w-4/5 mx-auto my-20">
        <div class="w-full flex items-start py-2 pl-1">
            <x-teal-button wire:click="toggleNewBookFormHandler">New +</x-teal-button>
        </div>

        @if($state['isTableVisible'])
            <x-admin.books :sortField="$sortField" :sortAsc="$sortAsc" :books="$books" />

        @elseif($state['isNewBookFormVisible'])
            @livewire('admin-create')
        
        @elseif($state['isEditFormVisible']) 
            @livewire('admin-edit-book', ['book' => $editBook])
        @endif
        
        @if($state['isDeleteFormVisible'])
            @livewire('admin-delete', ['book' => $deleteBook])
        @endif
    </div>
</div>
