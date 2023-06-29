<x-layout>
    {{-- main page for admin books, shows all books --}}
    <section id="admin" class="min-h-screen flex"> 
        <x-admin.nav />
        
        <main class="flex-1 text-center w-4/5 ">
            <h1 class="text-4xl mt-8 font-bold">Admin - All Books</h1>

            @livewire('admin-books')
        </main>
    </section>
</x-layout>
