<nav class="bg-white border-b sticky left-0 right-0 top-0 z-10">
    <div class="max-w-[986px] flex w-full justify-between items-center py-3 mx-auto">
        <div>
            <x-logo-brand size="60px" class="text-xl" />
        </div>

        @auth
            <div class="font-bold text-center mx-auto">
                <a href="/clients" class="hover:bg-gray-200 px-3 py-1 rounded">Clients</a>
                <a href="/" class="hover:bg-gray-200 px-3 py-1 rounded">Vehicles</a>
            </div>

            <div class="font-bold flex">
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')

                    <button class="hover:bg-gray-200 px-3 py-1 rounded">Log Out</button>
                </form>
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
