<nav class="bg-white border-b sticky left-0 right-0 top-0 z-10">
    <div class="max-w-[986px] flex w-full justify-between items-center py-3 mx-auto">
        <div>
            <x-logo-brand size="60px" class="text-xl" />
        </div>

        @auth
            <div class="font-bold text-center mx-auto w-1/2">
                <x-searchbar />
            </div>

            <div class="font-bold flex">
                <x-avatar-with-dropdown />
            </div>
        @endauth

        @guest
            <div></div>
            <div class="font-bold">
                <a href="/register" class="hover:bg-gray-200 px-3 py-1 rounded">Sign Up</a>
                <a href="/login" class="hover:bg-gray-200 px-3 py-1 rounded">Log In</a>
            </div>
        @endguest
    </div>
</nav>
