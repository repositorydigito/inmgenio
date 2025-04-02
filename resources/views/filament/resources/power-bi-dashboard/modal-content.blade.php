<div class="h-full flex flex-col bg-gray-50">
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
                @if($record->permissions)
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        <span>Permisos: {{ $record->permissions }}</span>
                    </div>
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