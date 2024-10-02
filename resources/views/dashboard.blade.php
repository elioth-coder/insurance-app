<x-layout>
    @if (Auth::user()->role !== 'subagent')
        <h2 id="authentications" class="pt-2 text-xl mx-1 mt-5 mb-2">Today's Authentications</h2>
        <section class="flex space-x-5">
            @foreach ($authentications as $authentication)
                <div
                    class="min-w-[175px] border bg-white text-violet-800 py-3 rounded-lg flex flex-col items-center justify-between w-auto">
                    <h1 class="text-center text-7xl">{{ $authentication->count }}</h1>
                    <h2 class="mt-1 text-center text-lg text-black font-thin">{{ $authentication->branch_name }}</h2>
                </div>
            @endforeach
        </section>
    @endif

    <h2 id="introduction" class="pt-2 text-xl mx-1 mt-5 mb-2">Introduction</h2>
    <section class="border bg-white p-8 rounded-lg">
        <h3 class="text-2xl font-bolder">Welcome! to iVeIM System<sup>v1.0.0</sup></h3>
        <hr class="mt-1 mb-2">
        <p>An Integrated Vehicle Insurance Management System for the hardworking Filipinos.</p>
    </section>
    <div class="flex my-5 space-x-5">
        <div class="w-full">
            <h3 id="announcement" class="pt-1 text-xl mb-2">Announcements</h3>
            @forelse ($announcements as $announcement)
                <div id="alert-announcement-content-{{ $announcement->id }}"
                    {{-- text-gray-800 text-red-800 text-yellow-800 text-green-800 text-blue-800 text-indigo-800 text-purple-800 text-pink-800 --}}
                    {{-- border-gray-300 border-red-300 border-yellow-300 border-green-300 border-blue-300 border-indigo-300 border-purple-300 border-pink-300 --}}
                    class="p-4 mb-4 text-{{ $announcement->color }}-800 border border-{{ $announcement->color }}-300 rounded-lg bg-white"
                    role="alert">
                    <div class="flex flex-col">
                        <h3 class="text-2xl font-semibold">{{ $announcement->title }}</h3>
                        <p class="text-xs">Aug 10, 2024 12:31 PM</p>
                    </div>
                    {{-- bg-gray-200 bg-red-200 bg-yellow-200 bg-green-200 bg-blue-200 bg-indigo-200 bg-purple-200 bg-pink-200 --}}
                    <hr class="h-px my-2 bg-{{ $announcement->color }}-200 border-0">
                    <div class="mt-2 mb-4 text-sm text-justify text-black">
                        {{ $announcement->content }}
                    </div>
                    <div class="flex">
                        <button type="button"
                            {{-- bg-gray-800 bg-red-800 bg-yellow-800 bg-green-800 bg-blue-800 bg-indigo-800 bg-purple-800 bg-pink-800 --}}
                            {{-- hover:bg-gray-900 hover:bg-red-900 hover:bg-yellow-900 hover:bg-green-900 hover:bg-blue-900 hover:bg-indigo-900 hover:bg-purple-900 hover:bg-pink-900 --}}
                            {{-- focus:ring-gray-200 focus:ring-red-200 focus:ring-yellow-200 focus:ring-green-200 focus:ring-blue-200 focus:ring-indigo-200 focus:ring-purple-200 focus:ring-pink-200 --}}
                            class="text-white bg-{{ $announcement->color }}-800 hover:bg-{{ $announcement->color }}-900 focus:ring-4 focus:outline-none focus:ring-{{ $announcement->color }}-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center">
                            <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            View more
                        </button>
                        <button type="button"
                            class="text-{{ $announcement->color }}-800 bg-transparent border border-{{ $announcement->color }}-800 hover:bg-{{ $announcement->color }}-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-{{ $announcement->color }}-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                            data-dismiss-target="#alert-announcement-content-{{ $announcement->id }}" aria-label="Close">
                            Dismiss
                        </button>
                    </div>
                </div>
            @empty
                <h1 class="text-center my-5 text-3xl">No announcements so far.</h1>
            @endforelse
        </div>
        <div class="min-w-[350px]">
            <h3 id="quick_search" class="pt-1 text-xl mb-2">Quick Search (COC,Plate,MV File No.)</h3>
            <x-quick-searchbar />
            <section class="pl-6 mb-5">
                <h2 class="my-2 mt-3 text-gray-500 font-semibold text-sm">What is Quick Search for?</h2>
                <ul class=" pl-6 space-y-1 text-gray-500 list-inside">
                    <li class="flex items-start">
                        <svg class="w-3.5 h-3.5 me-2 mt-1 text-green-500 flex-shrink-0"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Use Quick Search to verify MV details for Claims.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-3.5 h-3.5 me-2 mt-1 text-green-500 flex-shrink-0"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Use COC Search to verify System Errors.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-3.5 h-3.5 me-2 mt-1 text-green-500 flex-shrink-0"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Use Plate No. Search as an alternative if you cannot locate vehicle details using COC Search.
                    </li>
                </ul>
            </section>
            <h3 id="activity_logs" class="pt-1 text-xl mb-2">Activity Logs</h3>
            <x-logs />
        </div>
    </div>
</x-layout>
