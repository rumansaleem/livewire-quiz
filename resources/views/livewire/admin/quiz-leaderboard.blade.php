<div class="h-screen container mx-auto flex flex-col items-center">
    <h2 class="text-5xl font-bold italic mt-6 mb-8">Leaderboard</h2>

    <div class="flex-1 h-full w-full">
        @foreach($players as $index => $player)
        <div class="w-full flex items-center text-2xl font-bold py-2 px-4 rounded-lg {{ $index == 0 ? 'bg-purple-700' : 'bg-purple-600' }} mb-2">
            <div class="w-20 pl-6 pr-6 text-right">{{ $index + 1 }}</div>
            <div class="px-4 flex-1 truncate">{{ $player->nickname }}</div>
            <div class="w-32 pl-4 pr-6 text-right">{{ $player->score }}</div>
        </div>
        @endforeach
    </div>
    <div class="my-4">
        <a href="{{ route('admin.home') }} " class="bg-purple-700 text-white text-2xl font-bold px-4 py-2 rounded">Home</a>
    </div>
</div>
