<button 
{{ $attributes->merge(['class' => 'text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br hover:drop-shadow-lg focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2']) }} 
type="button"
    >{{ $slot }}
</button>
