@props(['header', 'list'])

<div x-data="
    {
        open : false
    }" 

    class="text-white mt-9 relative w-fit">
    <button @click="open = !open" class="bg-blue-500 rounded-full py-2 px-5">
      {{ $header }}
    </button>

    <div x-show="open" @click.away="open = false" class="block bg-blue-500 rounded p-3 mt-3 absolute top-full left-0 right-0 text-center z-10 h-60 overflow-scroll">
        <ul>
            {{ $list }}
        </ul>
    </div>
</div>