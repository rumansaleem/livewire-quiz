<div class="h-screen flex flex-col justify-center items-center">
    @if($enteredSession)
    <h3 wire:transition.fade class="text-2xl font-bold py-4 mb-6 text-center">
        {{ $enteredSession->quiz->title }}
    </h3>
    @endif
    <div class="max-w-lg mx-auto">
        @if(! $enteredSession)
        <h2 class="mb-6 text-4xl font-bold text-center py-2">Enter Quiz Pin</h2>
        <form wire:transition.fade wire:key="enter-quiz" wire:submit.prevent="enter" class="text-center">
            <div class="mx-auto text-xl text-black mb-6">
                <input type="number"
                    class="w-full px-4 py-2 bg-gray-200 hover:bg-white focus:bg-white tracking-widest rounded shadow-md"
                    style="width: 7em;"
                    min="100000" max="999999"
                    autofocus
                    wire:model="pin" placeholder="123456">
                @error('pin')
                <p class="font-bold px-4 mt-2 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="mx-auto text-xl mb-6">
                <button type="submit" class="px-4 py-2 text-white bg-purple-700 hover:bg-purple-600 font-bold rounded shadow-lg">
                    Enter Quiz
                </button>
            </div>
        </form>
        @else
        <h2 class="mb-6 text-4xl font-bold text-center py-2">Enter Nickname</h2>
        <form wire:transition.fade wire:key="ready-for-quiz" wire:submit.prevent="ready" class="text-center">
            <div class="mx-auto text-xl text-black mb-6">
                <input type="text"
                    class="w-full px-4 py-2 bg-gray-200 hover:bg-white focus:bg-white tracking-widest rounded shadow-md"
                    autofocus
                    wire:model="nickname"
                    placeholder="e.g. John">
                @error('nickname')
                <p class="font-bold px-4 mt-2 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="mx-auto text-xl mb-6">
                <button type="submit"
                    class="px-4 py-2 text-white bg-purple-700 hover:bg-purple-600 font-bold rounded shadow-lg">
                    Ready!
                </button>
            </div>
        </form>
        @error('nickname')
        <p class="px-4 mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
        @endif
    </div>
</div>
