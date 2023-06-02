<x-layout>
    <section id="admin" class="min-h-screen flex">
        
        <x-admin.nav />
        
        <main class="flex-1 text-center w-4/5 ">
            <h1 class="text-4xl mt-8 font-bold">Admin - All Books</h1>

            <x-admin.books-table :books="$books" />
            <div class="flex justify-end my-8 mr-32">
                {{ $books->links()}}
            </div>
        </main>
    </section>
</x-layout>