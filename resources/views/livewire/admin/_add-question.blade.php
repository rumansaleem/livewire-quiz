<div>
    <h4 class="text-2xl font-bold mb-4">Add Question</h4>
    <form wire:submit.prevent="create">
        <div class="mb-2">
            <label for="text" class="w-full text-xs uppercase font-bold tracking-wide mb-1">Text</label>
            <textarea id="text" wire:model="text" class="w-full px-3 py-2 border rounded bg-white" rows="2"></textarea>
            {{-- @error('text')
                <p class="text-red-600 mt-2">{{ $message }}</p>
            @enderror --}}
        </div>
        <div class="mb-2">
            <label for="time_limit" class="w-full text-xs uppercase font-bold tracking-wide mb-1">Time Limit</label>
            <input id="time_limit" type="number" wire:model="timeLimit" class="w-full px-3 py-2 border rounded bg-white" />
            {{-- @error('timeLimit')
            <p class="text-red-600 mt-2">{{ $message }}</p>
            @enderror --}}
        </div>
        <div class="flex items-baseline mt-3 mb-1 leading-none">
            <label class="mr-4 text-xs uppercase font-bold tracking-wide">Options</label>
            <button wire:click="removeOption" type="button"
                class="px-2 border bg-gray-100 hover:bg-gray-200 rounded">-</button>
            <button wire:click="addOption" type="button"
                class="ml-2 px-2 border bg-gray-100 hover:bg-gray-200 rounded">+</button>
        </div>
        {{-- @error('options')
        <p class="mb-1 text-red-600">{{ $message }}</p>
        @enderror --}}
        <div>
            @foreach($options as $index => $option)
                <div class="flex items-center mb-2" wire:key="{{$index}}-option">
                    <p class="mr-2 font-bold">{{ $this->keys($index) }}) </p>
                    <input type="text" wire:model="options.{{ $index }}"
                        class="w-full px-3 py-2 border rounded bg-white flex-1 mr-2"
                        placeholder="Option ({{ $this->keys($index) }})">
                    <button type="button"
                        class="leading-none font-bold p-2 text-gray-600 hover:text-red-600 hover:bg-gray-200 rounded"
                        wire:click="removeOption({{ $index }})">&cross;</button>
                </div>
            @endforeach
        </div>
        <div class="mb-2">
            <label for="correct_key" class="w-full text-xs uppercase font-bold tracking-wide mb-1">
                Correct Answer
            </label>
            <select class="w-full px-3 py-2 border rounded bg-white"
                wire:model="correctOptionIndex"
                @change="@this.set('correctOptionIndex', $event.target.value)">
                @foreach($options as $option)
                <option value="{{ $loop->index }}"
                    wire:key="{{$loop->index + 1}}-option"
                    {{ $loop->index === (int) $correctOptionIndex ? 'selected' : '' }}
                    >
                    {{ $this->keys($loop->index) }}) {{ $option }}
                </option>
                @endforeach
            </select>
        </div>
        {{-- @error('correctOptionIndex')
            <p class="text-red-600 mt-2">{{ $message }}</p>
        @enderror --}}
        <div wire:key="submit-button">
            <button class="px-3 py-2 rounded bg-blue-500 text-white font-bold text-sm">Create</button>
        </div>
    </form>
</div>
