<x-layout>
    <section id="login" class="h-screen">

        <h1 class="text-center my-7">Login</h1>

        <form action="/log-in" method="POST" class="max-w-lg mx-auto my-8">
            @csrf

            <x-form.text-input class="my-3" name="email" type="email" />
            <x-form.text-input class="my-3" name="password" type="password" />

            <x-form.submit class="mt-6" />
        </form>

    </section>
</x-layout>