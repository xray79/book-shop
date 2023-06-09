@props(['name', 'type' => 'text', 'isLabelled' => True, ])

@php
    use App\Helpers\Helpers;
    $dashedName = Helpers::dashedName($name);
@endphp

@if ($isLabelled)
    <x-form.label :name="$name" />
@endif

<input 
    {{ $attributes(['class' => 'border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500']) }}
    name="{{ $dashedName }}"
    id="{{ $dashedName }}" 
    value="{{ old($dashedName) }}"
    type="{{ $type }}"
    placeholder="{{ ucwords($name) }}"
>

@error( $dashedName )
    <p class="text-xs text-red-500 mb-5">{{ $message }}</p>
@enderror


