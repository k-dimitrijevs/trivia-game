<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Trivia Game

                    <div class="buttons flex">
                        <form method="post" action="{{ route('trivia.store') }}">
                            @csrf
                            <button type="submit">
                                <div class="btn p-2 mt-1 px-4 rounded font-semibold cursor-pointer text-gray-200 bg-yellow-500">
                                    Start Game
                                </div>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
