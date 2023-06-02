@props(['name', 'type' => 'text', 'isLabelled' => True])

@if ($isLabelled)
    <x-form.label name="{{ $name }}" />
@endif

<input 
    {{ $attributes(['class' => 'border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500']) }}
    name="{{ str_replace(' ', '-', strtolower($name)) }}"
    type="{{ $type }}" 
    id="{{ str_replace(' ', '-', strtolower($name)) }}" 
    placeholder="{{ ucwords($name) }}"
    value="{{ old( str_replace(' ', '-', strtolower($name)) ) }}"
    required>

@error( str_replace(' ', '-', strtolower($name)) )
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
@enderror


