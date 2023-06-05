<x-layout>
    <section id="admin" class="min-h-screen flex">
        
        <x-admin.nav />
        
        <main class="flex-1 text-center w-4/5 ">
            <form 
                action="/admin/categories" 
                method="post" 
                class="mt-8 flex flex-col items-center justify-center space-y-3 mx-auto">
                @csrf

                <h2>Add a new category</h2>

                <div class="flex items-center justify-center space-x-2">
                    <x-form.text-input 
                        name="category" 
                        isLabelled="false"/>
                        
                    <x-form.submit />
                </div>
            </form>

            <x-admin.categories-table :categories="$categories" />
            
            <div class="flex justify-end my-8 mr-32">
                {{ $categories->links() }}
            </div>
        </main>
    </section>
</x-layout>