<div class="flex flex-col bg-purple-500 text-white justify-center items-center min-h-screen" wire:poll.1s="redirectIfActive">
    <div class="max-w-md mx-auto text-center p-4">
        <h2 class="text-xl font-bold">{{ $session->quiz->title }}</h2>
    </div>
    <div class="flex-1">
        <div class="flex flex-wrap gap-6" wire:poll.2s="loadPlayers">
            @foreach ($session->players as $player)
                <div class="bg-purple-600 rounded py-2 px-4 text-xl font-bold italic">
                    {{ $player->nickname }}
                </div>
            @endforeach
        </div>
    </div>
    <p class="py-6">Waiting for players...</p>
</div>
