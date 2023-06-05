<x-layout>
    <x-session.tabs />

    <div class="h-screen">
        <x-session.books-table :books="$books" />
    </div>
</x-layout>