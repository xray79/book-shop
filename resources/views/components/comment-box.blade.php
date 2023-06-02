@props(['book_id'])

<form action="/add-comment" method="POST" class="mt-5 mb-20">
    @csrf
    <input type="number" name="book_id" value="{{$book_id}}" hidden />

    <div class="mb-4 border rounded-lg bg-gray-700 border-gray-600">
        <div class="px-4 py-2 rounded-t-lg bg-gray-800">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" name="text" rows="4" class="w-full p-3 text-sm border-0 bg-gray-800 focus:ring-0 text-white placeholder-gray-400" placeholder="Write a comment..." required></textarea>
        </div>

        <div class="flex items-center justify-end px-3 py-3 ml-auto border-t border-gray-600">
            <x-form.submit />
        </div>
    </div>
</form>
