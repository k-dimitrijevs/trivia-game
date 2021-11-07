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
                    <div class="p-6 bg-white">
                        <p>Select Answer:</p>
                        @foreach($answers as $answer)
                            <div class="p-1">
                                <input type="radio" id="radio" value="{{ $answer }}" name="answer">{{ $answer }}
                            </div>
                        @endforeach

                        @error('answer')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="buttons flex mt-5">
                            <button>
                                <div class="btn border border-indigo-500 p-1 px-4 font-semibold rounded cursor-pointer text-white bg-blue-500">
                                    Submit
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
