<x-layout>
    <section id="admin" class="min-h-screen flex">
        
        <x-admin.nav />
        
        <main class="flex-1 w-4/5">
            <h1 class="mt-5 font-bold text-center text-3xl">Admin - Upload a new book</h1>

            <x-admin.upload-form :users="$users" :books="$books" :categories="$categories" />
        </main>
    </section>
</x-layout>