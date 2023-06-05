<div x-data="{ show : true }"
             x-init="setTimeout(() => show = false, 2500)"
             x-show="show"
             x-transition.duration.500ms
             class="fixed top-20 right-10">
             {{ $slot }}
</div>