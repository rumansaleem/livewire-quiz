<div  @if(! $isReady) wire:poll.1s="isReady" @endif
    class="h-screen bg-purple-500 text-white flex flex-col items-center justify-center p-4">
    <h2 class="text-5xl font-bold text-center mb-12">{{ $quizSession->quiz->title }}</h2>
    @if($isReady && $secsLeft > 0)
        <p>Countdown begins!</p>
        <div @if($secsLeft > 0) wire:poll.1s="countdown" @endif
            class="text-5xl p-4 leading-tight">
            {{ $secsLeft }}
        </div>
    @elseif($secsLeft <= 0 && $question)
        <p class="p-6 rounded bg-purple-600 text-2xl font-mono font-bold tracking-wide mb-8">{{ $question->text }}</p>
        <div class="w-full flex-1 grid grid-cols-2 gap-8 content-start">
            @php($bgColors = ['bg-blue-400 text-white', 'bg-red-500 text-white', 'bg-green-400 text-white', 'bg-yellow-400 text-black'])
            @php($shapes = ['triangle', 'hexagon', 'circle', 'star'])
            @foreach(array_values($question->options) as $key => $option)
            <button class="{{ $bgColors[$loop->index] }} text-2xl font-mono font-bold tracking-wide px-8 py-6 flex items-center rounded"
                wire:click.prevent="storeAnswer({{$key}})">
                @php($angle = (180 * ($loop->index + 1) / ($loop->index + 3)))
                @include('svg.shapes.' . $shapes[$loop->index], ['classes' => 'h-12 mr-6 '])
                {{ $option }}
            </button>
            @endforeach
        </div>
    @else
        <div class="flex flex-wrap gap-6">
            @foreach ($quizSession->players as $player)
                <div class="bg-purple-600 rounded py-2 px-4 text-xl font-bold italic">{{ $player->nickname }}</div>
            @endforeach
        </div>
        <p class="mt-6">Waiting for players...</p>
    @endif
</div>
