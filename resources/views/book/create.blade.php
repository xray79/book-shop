<x-layout>
    <main class="min-h-screen">
        <h1 class="text-center mt-10">Upload - create a new book</h1>

        <x-upload-form :categories="$categories" />
    </main>
</x-layout>