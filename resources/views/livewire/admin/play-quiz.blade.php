@php($bgColors = ['bg-blue-400 text-white', 'bg-red-500 text-white', 'bg-green-400 text-white', 'bg-yellow-400 text-black'])
@php($shapes = ['triangle', 'hexagon', 'circle', 'star'])
<div class="container mx-auto flex flex-col min-h-screen">
    <h2 class="text-2xl font-bold text-center my-8">{{$session->quiz->title}}</h2>
    @if (! $showAnswers)
    <p class="p-6 rounded bg-purple-600 text-2xl font-mono font-bold tracking-wide mb-8" wire:init="pollShowAnswers">{{ $question->text }}</p>
    <div class="w-full flex-1 grid grid-cols-2 gap-8 content-start">
        @foreach(array_values($question->options) as $key => $option)
        <button
            class="{{ $bgColors[$loop->index] }} text-2xl font-mono font-bold tracking-wide px-8 py-6 flex items-center rounded">
            @include('svg.shapes.' . $shapes[$loop->index], ['classes' => 'h-12 mr-6'])
            {{ $option }}
        </button>
        @endforeach
    </div>
    @else
        <div class="w-full md:w-screen-md md:self-center flex-1 flex items-end justify-center h-full mb-12 border-b">
            @foreach($optionPolls as $key => $count)
            @php($percent = $count/$session->players->count() * 100)
            <div class="px-4 flex flex-col items-center justify-between {{ $bgColors[$loop->index] }} rounded-t p-2 mx-1 font-bold text-2xl"
                {{ $percent > 0 ? "style=height:{$percent}%" : ''}}>
                @if ($question->correct_key == $key)
                    <span class="mb-4">&check;</span>
                @endif
                <div>{{ $count }}</div>
            </div>
            @endforeach
        </div>
    @endif
</div>
