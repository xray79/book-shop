<x-layout>
    <section id="register" class="h-screen">
        @csrf
        <h1 class="text-center my-7">Register</h1>

        <form action="/register" 
              method="POST" 
              enctype="multipart/form-data" 
              class="max-w-lg mx-auto my-8">
            @csrf

            <x-form.text-input class="my-2" name="name" />
            <x-form.text-input class="my-2" name="email" type="email" />
            <x-form.text-input class="my-2" name="password" type="password" />
            <x-form.text-input class="my-2" name="confirm password" type="password" />

            <x-form.submit class="mt-6" />
        </form>

    </section>
</x-layout>