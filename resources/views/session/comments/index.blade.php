<x-layout>
    <x-session.tabs />

    <section class="min-h-screen h-fit pb-40">
        <x-session.comments-table :comments="$comments" />
    </section>
</x-layout>