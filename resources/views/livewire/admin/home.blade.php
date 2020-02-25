<div class="max-w-md mx-auto flex flex-col items-center justify-center min-h-screen leading-none">
    <div class="fixed bottom-0 right-0 mb-12 mr-12">
        <button class="bg-blue-500 text-white rounded-full shadow-lg p-3">
            <svg class="h-6" viewBox="0 0 20 20" stroke-width="2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <line x1="2" y1="10" x2="18" y2="10"></line>
                <line x1="10" y1="2" x2="10" y2="18"></line>
            </svg>
        </button>
    </div>
    <h2 class="self-start text-xl font-bold mb-4">Quizzes</h2>
    @foreach ($quizzes as $quiz)
        <div class="w-full bg-white text-gray-900 py-3 px-6 rounded border shadow">
            <h3 class="text-lg font-bold mb-3">{{ $quiz->title }}</h3>
            <p>
                <button wire:click="startSession({{ $quiz->id }})"
                    class="text-sm px-2 py-1 rounded bg-blue-500 text-white font-bold">
                    Start
                </button>
            </p>
        </div>
    @endforeach
</div>
