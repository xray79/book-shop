<div x-data="{open : false}">
    <button @click="open = !open" >
        {{ $slot }}
    </button>
    
    <div x-show="open" x-cloak>
        <div 
            class="fixed top-0 left-0 z-20 w-screen h-screen backdrop-blur-lg flex items-center justify-center"
            x-transition>

            <div class="bg-red-500 text-black p-5">
                <p @click.away="open = false">item will be permanently deleted</p>
                <div class="w-20 text-center space-x-4 mx-auto">

                    <form action="" method="" class="inline hover:scale-150">
                        <button>Y</button>
                    </form>

                    <button @click="open = false">N</button>
                </div>
            </div>
        </div>
    </div>
</div>