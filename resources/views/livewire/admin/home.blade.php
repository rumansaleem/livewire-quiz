<div class="max-w-md mx-auto flex flex-col justify-center min-h-screen leading-none">
    <div class="fixed bottom-0 right-0 mb-12 mr-12">
        <button class="bg-blue-500 text-white rounded-full shadow-lg p-3">
            <svg class="h-6" viewBox="0 0 20 20" stroke-width="2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <line x1="2" y1="10" x2="18" y2="10"></line>
                <line x1="10" y1="2" x2="10" y2="18"></line>
            </svg>
        </button>
    </div>
    <h2 class="self-start text-xl font-bold mb-4">Quizzes</h2>
    @forelse($quizzes as $quiz)
        <div class="w-full bg-white text-gray-900 py-3 px-6 rounded border shadow flex items-baseline">
            <h3 class="text-lg font-bold mr-3">{{ $quiz->title }}</h3>
            @if( ! $quiz->freshSession)
            <button wire:click="startSession({{ $quiz->id }})"
                class="ml-auto px-2 py-1 text-sm rounded bg-blue-500 hover:bg-blue-700 text-white font-bold">
                Start
            </button>
            @else
                <a href="{{ route('admin.quiz.start', $quiz->freshSession) }}"
                    class="ml-auto px-2 py-1 text-sm rounded bg-blue-500 hover:bg-blue-700 text-white font-bold">
                    Resume
                </a>
            @endif
        </div>
    @empty
        <p>No quizzes created.</p>
    @endforelse
</div>
