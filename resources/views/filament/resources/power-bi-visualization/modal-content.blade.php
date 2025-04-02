<div class="h-full flex flex-col bg-gray-50 h-screen">
    <div class="p-4 bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <div class="p-2 bg-primary-100 rounded-lg">
                <svg class="w-6 h-6 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900">{{ $record->title }}</h3>
                @if($record->description)
                    <p class="text-sm text-gray-500 mt-1">{{ $record->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="flex-1 p-4">
        <div class="h-full bg-white rounded-lg shadow-sm overflow-hidden">
            <iframe 
                src="{{ $record->embed_url }}" 
                frameborder="0" 
                allowfullscreen 
                class="w-full h-full"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                style="border: none;"
            ></iframe>
        </div>
    </div>
</div> 