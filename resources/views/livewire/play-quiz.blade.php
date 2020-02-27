<div class="h-screen bg-purple-500 text-white flex flex-col items-center justify-center p-4">
    @if(! $response)
    <div class="w-full flex-1 grid grid-cols-2 gap-6 md:gap-8 h-full">
        @php($bgColors = ['bg-blue-400 text-white', 'bg-red-500 text-white', 'bg-green-400 text-white', 'bg-yellow-400 text-black'])
        @php($shapes = ['triangle', 'hexagon', 'circle', 'star'])
        @foreach($question->options as $key => $option)
        <button class="{{ $bgColors[$loop->index] }} p-6 flex items-center justify-center rounded"
            wire:click.prevent="storeAnswer('{{$key}}')">
            @include('svg.shapes.' . $shapes[$loop->index], ['classes' => 'w-48'])
        </button>
        @endforeach
    </div>
    @else
        @include('partials.spinner', ['classes' => 'w-16 h-16'])

        <p class="text-center text-lg font-bold">
            Waiting for others to answer...
        </p>
    @endif
</div>
