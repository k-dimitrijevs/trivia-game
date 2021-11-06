<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trivia Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <p>{{ $trivia->question }}</p>
                        <p>{{ $trivia->correct_answer }}</p>
                </div>

                <form method="post" action="/trivia/check">
                    @csrf
                    <p>Select Answer:</p>
                    @foreach($answers as $answer)
                        <input type="radio" id="radio" value="{{ $answer }}" name="answer">{{ $answer }}
                    @endforeach
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
