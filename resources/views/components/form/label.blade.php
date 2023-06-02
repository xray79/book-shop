@props(['name'])

<label 
    for="{{ str_replace(' ', '-', strtolower($name)) }}" 
    class="block mb-2 text-sm font-medium text-gray-900"
    >{{ ucwords($name) }}
</label>