@props(['href'])

<li>
    <a 
        href="{{ str_replace(' ', '-', strtolower($href)) }}" 
        class="block py-2 pl-3 pr-4 rounded md:hover:bg-transparent md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:dark:hover:bg-transparent ">{{ $slot }}</a>
</li>