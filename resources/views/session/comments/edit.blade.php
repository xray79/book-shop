<x-layout>
    <section class="my-4 min-h-screen">
        <div class="container mx-auto">

            <a href="/my-account/comments" class="hover:underline">Back to my comments</a>

            <h1 class="text-center">Edit your comment</h1>
            
            <div class="mx-auto w-1/2">
                <form action="/my-account/comments/{{ $comment->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <x-form.text-input name="comment" value="{{ $comment->text }}" class="my-3"/>
                    
                    <x-form.submit />
                </form>
            </div>
        </div>
    </section>
</x-layout>