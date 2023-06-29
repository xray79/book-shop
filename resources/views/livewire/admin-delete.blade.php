<div class="fixed top-0 left-0 right-0 bottom-0 bg-slate-500 bg-opacity-95 z-50">
    <div class="w-full h-full grid items-center">

        <div class="bg-slate-300 mx-auto rounded w-1/2 py-10 px-20 space-y-9">
            <h1>Book <span class="font-bold">"{{ $book->title }}"</span> will be deleted</h1>
            <div class="space-x-6">
                <x-green-button wire:click="emitDeleteBookEvent">Confirm</x-green-button>
                <x-red-button wire:click="emitToggleDeleteFormEvent">Cancel</x-red-button>
            </div>
        </div>

    </div>
</div>
