
<nav class="border-gray-200 bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <x-navbar.logo>Book Shop</x-navbar.logo>
    <x-navbar.toggle />

    <div class="hidden w-full md:block md:w-auto z-10" id="navbar-default">
      <ul class="font-medium flex flex-col items-center justify-center p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-gray-800 md:bg-gray-900 border-gray-700">

            @guest
              <x-navbar.item :href="'/log-in'">Log in</x-navbar.item>
              <x-navbar.item :href="'/register'">Register</x-navbar.item>
            @endguest

            @auth
              <form action="/log-out" method="post" class="my-auto">
                @csrf
                <button class="text-white hover:text-blue-500" type="submit">Log Out</button>
              </form>
              <x-navbar.item :href="'/my-account'">My Account</x-navbar.item>
            @endauth
            
            <x-navbar.item :href="'/upload'">Upload</x-navbar.item>
      </ul>
    </div>
  </div>
</nav>
