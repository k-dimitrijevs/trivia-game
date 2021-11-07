<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Better luck next time!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Total questions answered: {{ $correctAnswers }}</p>
                    <p class="text-2xl font-bold">You answered wrong!</p>

                    <p class="text-lg font-bold">Question:</p>
                    {{ $trivia->question }}

                    <p class="text-lg font-bold">Your answer:</p>
                    {{ $trivia->answer }}

                    <p class="text-lg font-bold">Correct answer:</p>
                    {{ $trivia->correct_answer }}

                    <div class="buttons flex">
                        <div class="btn p-2 mt-1 px-4 rounded font-semibold cursor-pointer text-gray-200 bg-yellow-500">
                            <a href="{{ route('dashboard') }}">Return to start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
