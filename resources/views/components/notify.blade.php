@props([
    'heading' => 'Have an Issue?',
    'button',
])

<div
    class="fixed inset-0 top-0 left-0 z-50 flex flex-col items-center justify-start h-screen pt-8 space-y-4 bg-gray-100 outline-none min-w-screen animated fadeIn faster focus:outline-none">
    <div class="flex flex-col p-5 bg-white border-l-4 shadow-md border-l-indigo-600 hover:shodow-lg rounded-2xl">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 p-3 text-blue-400 border border-blue-100 rounded-2xl bg-blue-50" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex flex-col ml-3">
                    <div class="font-medium leading-none">{{ $heading }}</div>
                    <p class="mt-1 text-sm leading-none text-gray-600">
                        {{ $slot }}
                    </p>
                </div>
            </div>
            <a
                {{ $button->attributes->class(['px-5 py-2 ml-4 text-sm font-medium tracking-wider text-center text-white bg-red-500 border-2 border-red-500 rounded-full shadow-sm flex-no-shrink hover:shadow-lg truncate w-full sm:w-auto']) }}>{{ $button }}</a>
        </div>
    </div>
</div>
