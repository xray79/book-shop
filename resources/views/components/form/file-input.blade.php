@props(['name'])

<label 
    class="block mb-2 text-sm font-medium text-black" 
    for="{{ $name }}"
    >Upload {{ ucwords($name) }}
</label>

<input 
    {{ $attributes(['class' => "block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"]) }}
    id="{{ $name }}" 
    name="{{ strtolower($name) }}"
    type="file" 
/>

@error( strtolower($name) )
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror