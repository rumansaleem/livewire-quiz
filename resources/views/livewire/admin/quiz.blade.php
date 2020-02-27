<div class="flex flex-col bg-purple-500 text-white justify-center items-center min-h-screen">
    <div class="max-w-md mx-auto text-center p-4">
        <h2 class="text-xl font-bold">Game Pin</h2>
        <p class="text-5xl font-bold">{{ $session->pin }}</p>
    </div>
    <div class="flex-1">
        <div class="flex flex-wrap gap-6">
            @foreach ($session->players as $player)
                <div class="bg-purple-600 rounded py-2 px-4 text-xl font-bold italic">{{ $player->nickname }}</div>
            @endforeach
        </div>
    </div>
    <div class="my-6">
        <button wire:click="start"
            class="px-4 py-2 font-bold bg-purple-700 text-white rounded text-xl">
            Ready!
        </button>
    </div>
    <p class="py-6">Waiting for players...</p>
</div>
