<div class="container mx-auto flex flex-col min-h-screen">
    <h2 class="text-2xl font-bold text-center my-8">{{$session->quiz->title}}</h2>
    <p class="p-6 rounded bg-purple-600 text-2xl font-mono font-bold tracking-wide mb-8">{{ $question->text }}</p>
    <div class="w-full flex-1 grid grid-cols-2 gap-8 content-start">
        @php($bgColors = ['bg-blue-400 text-white', 'bg-red-500 text-white', 'bg-green-400 text-white', 'bg-yellow-400
        text-black'])
        @php($shapes = ['triangle', 'hexagon', 'circle', 'star'])
        @foreach(array_values($question->options) as $key => $option)
        <button
            class="{{ $bgColors[$loop->index] }} text-2xl font-mono font-bold tracking-wide px-8 py-6 flex items-center rounded">
            @include('svg.shapes.' . $shapes[$loop->index], ['classes' => 'h-12 mr-6'])
            {{ $option }}
        </button>
        @endforeach
    </div>
</div>
