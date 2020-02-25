@if($errors->count() > 0)
<div class="fixed bottom-0 right-0 mb-4 flex flex-col" x-data="{show: true}">
    <ul x-show="show" @click.away="show = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        class="px-6 py-2 bg-red-300 border border-red-600 text-red-700 list-inside mb-2 mr-2 rounded list-disc">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button @click="show = !show"
        class="px-4 py-1 transition rounded-l bg-red-600 text-white text-left inline-flex items-center">
        <svg class="h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
            stroke-linejoin="round">
            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            x-transition:enter="transition ease-out duration-300"
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <span x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-x-64" x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
            x-transition:leave-end="transform translate-x-64" class="ml-2 font-bold">Errors</span>
    </button>
</div>
@endif
