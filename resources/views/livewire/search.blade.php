<div>
    <x-admin.livewire-search
        class="my-5"    
        wire:model="search"
    />

    @livewire('test',['searchResults' => $search])
</div>
