@props(['name'])

@php
    use App\Helpers\Helpers;
    $dashedName = Helpers::dashedName($name);
@endphp

<label 
    for="{{ $dashedName }}" 
    class="block mb-2 text-sm font-medium text-gray-900"
    >{{ ucwords($name) }}
</label>