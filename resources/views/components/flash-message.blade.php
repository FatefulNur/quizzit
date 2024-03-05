@props(['status'])

@if ($status)
    <div class="fixed z-50 w-full max-w-sm mx-auto my-2 overflow-hidden -translate-x-1/2 rounded shadow-sm top-2 left-1/2"
        x-data="{ hi: 'ndnsd' }" x-init="console.log(hi)">
        <div class="relative flex items-center justify-between px-2 py-2 font-bold text-white rounded-t bg-amber-600">
            <div class="relative flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="inline w-6 h-6 mr-2 opacity-75">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $status }}</span>
            </div>
            <span class="relative" x-on:click="$el.parentNode.parentNode.remove()">
                <svg class="w-5 h-5 fill-current text-amber-300 hover:text-white" role="button"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    </div>
@endif
