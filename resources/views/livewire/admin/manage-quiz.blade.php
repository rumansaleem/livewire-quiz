<div class="max-w-screen-md px-4 mx-auto relative">
    <h2 class="text-3xl text-center font-bold italic mt-6">{{ $quiz->title }}</h2>
    <p class="flex items-center justify-center font-bold mb-8">
        <span class="flex-1 text-right">{{ $quiz->questions->count() }} Questions</span>
        <span class="mx-4">|</span>
        <span class="flex-1">{{ $quiz->questions->sum('time_limit') }} seconds</span>
    </p>

    {{-- Old Sessions --}}
    <details>
        <summary class="cursor-pointer font-bold italic px-2 py-1 bg-blue-600 rounded">
            <div class="inline-flex items-center">
                Stale Sessions
                <span class="ml-4 text-xs bg-pink-600 rounded-full p-1 leading-none">{{ $quiz->sessions->count() }}</span>
            </div>
        </summary>
        <div class="ml-2 border-l pl-4 pt-4">
            @foreach ($quiz->sessions->filter->isStale() as $session)
                <div class="mb-4 bg-white rounded p-3 text-gray-900">
                    <p>
                        <strong>{{ $session->players->where('score', $session->players->max('score'))->first()->nickname }}</strong>
                        won
                        {{ $session->ended_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>
    </details>

    {{-- Questions --}}
    <details class="mt-1">
        <summary class="cursor-pointer font-bold italic px-2 py-1 bg-green-600 rounded">
            <div class="inline-flex items-center">
                Questions
                <span class="ml-4 text-xs bg-pink-600 rounded-full p-1 leading-none">{{ $quiz->questions->count() }}</span>
            </div>
        </summary>
        <div class="ml-2 border-l pl-4 pt-4">
            @foreach ($quiz->questions as $index => $question)
            <div class="mb-4 bg-white rounded p-3 text-gray-900" x-data="{showAnswer: false}">
                <p class="mb-3">
                    <strong class="float-left mr-2">{{ $index + 1 }}.</strong>
                    {!! $question->text !!}
                </p>
                <p class="mb-4 text-gray-800 font-bold italic">
                    Time Limit: {{ $question->time_limit }}s
                </p>
                <div class="flex flex-wrap -m-1">
                    @foreach ($question->options as $key => $option)
                        <div class="w-1/2 p-1">
                            <div class="bg-gray-200 rounded border px-3 py-1">
                                <strong class="float-left mr-2">{{$key}})</strong>
                                {{ $option }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex mt-2 items-baseline">
                    <button class="bg-purple-700 text-white font-bold text-sm px-2 py-1 rounded"
                        @click="showAnswer = !showAnswer"
                        x-text="showAnswer ? 'Hide Answer' : 'Show Answer'"></button>
                    <template x-if.fade="showAnswer">
                        <p class="ml-4 italic">
                            <strong class="mr-2">{{ $question->correct_key }})</strong>
                            {{ $question->options[$question->correct_key] }}
                        </p>
                    </template>
                </div>
            </div>
            @endforeach
        </div>
    </details>

    {{-- Add New Question Button --}}
    <div class="fixed z-30 bottom-0 right-0 mb-12 mr-12"
        x-data="{ creating: false }"
        x-init="window.livewire.on('closeModal', () => creating = false)">
        <button class="bg-pink-600 hover:bg-pink-700 text-white rounded-full shadow p-3" @click="creating = true">
            <svg class="h-6" viewBox="0 0 20 20" stroke-width="2" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round">
                <line x1="2" y1="10" x2="18" y2="10"></line>
                <line x1="10" y1="2" x2="10" y2="18"></line>
            </svg>
        </button>
        {{-- Add New Question Modal --}}
        <div wire:ignore.self
            x-show.fade="creating"
            @keydown.window.escape="creating = false"
            class="fixed z-50 inset-0 flex items-center justify-center p-8"
            style="background-color: rgba(0, 0, 0, 0.5)">
            <div @click.away="creating = false"
                class="max-w-screen-md max-h-full overflow-y-auto w-full bg-white text-gray-900 p-6 rounded shadow">
                @include('livewire.admin._add-question', ['quiz' => $quiz])
            </div>
        </div>
    </div>
</div>
