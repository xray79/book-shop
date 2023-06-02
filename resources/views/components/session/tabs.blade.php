<div class="text-sm font-medium text-center text-gray-400 border-gray-700 mx-auto px-5">
    <ul class="flex flex-wrap -mb-px">
        <li class="mr-2">
            <a 
                href="/my-account" 
                class="inline-block p-4 rounded-t-lg hover:border-b hover:border-gray-300 hover:text-gray-300 
                {{ request()->is('my-account') ? 'text-blue-600 border-b-2 border-blue-600' : ''}}" 
                >My Account</a>
        </li>
        <li class="mr-2">
            <a 
            href="/my-account/books" 
            class="inline-block p-4 rounded-t-lg hover:border-b hover:border-gray-300 hover:text-gray-300
            {{ request()->is('my-account/books') ? 'text-blue-600 border-b-2 border-blue-600' : ''}}" 
            >My Books</a>
        </li>
        <li class="mr-2">
            <a 
            href="/my-account/comments" 
            class="inline-block p-4 rounded-t-lg hover:border-b hover:border-gray-300 hover:text-gray-300
            {{ request()->is('my-account/comments') ? 'text-blue-600 border-b-2 border-blue-600' : ''}}" 
            >My Comments</a>
        </li>
    </ul>
</div>

