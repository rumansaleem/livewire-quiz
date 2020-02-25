<div class="h-screen flex flex-col justify-center items-center">
    <h2 class="mb-6 text-5xl font-bold py-2">DUCS Coding Club Quiz</h2>
    @if($enteredSession)
    <h3 wire:transition.fade class="text-2xl text-gray-800 font-bold py-4 mb-6">
        {{ $enteredSession->quiz->title }}
    </h3>
    @endif
    <div class="max-w-lg mx-auto">
        @if(! $enteredSession)
        <form wire:transition.fade wire:key="enter-quiz" class="flex" wire:submit.prevent="enter">
            <input type="text"
                class="flex-1 px-4 py-2 bg-gray-200 hover:bg-white focus:bg-white border border-r-0 rounded-l" autofocus
                wire:model="pin" placeholder="6-digit Quiz pin">
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-r">Enter Quiz</button>
        </form>
        @error('pin')
        <p class="px-4 mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
        @else
        <form wire:transition.fade wire:key="ready-for-quiz" class="flex" wire:submit.prevent="ready">
            <input name="nickname" type="text"
                class="flex-1 px-4 py-2 bg-gray-200 hover:bg-white focus:bg-white border border-r-0 rounded-l" autofocus
                wire:model.lazy="nickname" placeholder="Enter Nickname">
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-r">Ready!</button>
        </form>
        @error('nickname')
        <p class="px-4 mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
        @endif
    </div>
</div>

