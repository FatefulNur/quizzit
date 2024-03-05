<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Your Quizzes') }}
            </h2>

            @can('create-quiz')
                <a href="{{ route('user.quizzes.create') }}" wire:navigate
                    class="relative px-3 py-1 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:ring-2 ring-indigo-600 ring-offset-2 disabled:opacity-50">
                    Add New
                </a>
            @else
                <a href="{{ route('user.billings.plan') }}" wire:navigate
                    class="relative px-3 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-500 focus:ring-2 ring-red-600 ring-offset-2 disabled:opacity-50">
                    Upgrade Plan
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-4xl p-5 m-auto">

        <div class="flex flex-row-reverse items-center justify-start gap-4 mb-3 text-right">
            <select wire:model.live="date" class="border-none rounded-lg outline-none ring-2 ring-slate-600"
                name="date" id="date">
                <option value="">None</option>
                @foreach (App\Enums\QuizDateFilter::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->getLabel() }}</option>
                @endforeach
            </select>

            <div class="flex items-center justify-between">
                <label for="quiz_type"
                    class="mr-1 text-sm font-medium text-gray-900 cursor-pointer ms-3 dark:text-gray-300">Private?</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input wire:model.live="isPrivate" id="private" type="checkbox" value="private"
                        class="sr-only peer">
                    <div
                        class="w-9 h-5 shadow-sm bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                    </div>
                </label>
            </div>
        </div>


        <ul
            class="grid gap-3 grid-cols-[repeat(auto-fit,_minmax(280px,_1fr))] *:rounded-md *:shadow-lg *:border *:bg-white *:transition-all">
            @forelse ($quizzes as $quiz)
                <li
                    class="group relative {{ $quiz->isPrivate() ? 'border-amber-500 !bg-amber-50' : 'border-blue-500' }} hover:shadow-sm">
                    <div
                        class="absolute items-center justify-between hidden gap-2 px-2 py-1 w-fit group-hover:flex right-1 top-1 *:cursor-pointer">
                        <a href="{{ route('user.quizzes.edit', $quiz->id) }}" wire:navigate>
                            <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.7 5.12758L19.266 6.37458C19.4172 6.51691 19.5025 6.71571 19.5013 6.92339C19.5002 7.13106 19.4128 7.32892 19.26 7.46958L18.07 8.89358L14.021 13.7226C13.9501 13.8037 13.8558 13.8607 13.751 13.8856L11.651 14.3616C11.3755 14.3754 11.1356 14.1751 11.1 13.9016V11.7436C11.1071 11.6395 11.149 11.5409 11.219 11.4636L15.193 6.97058L16.557 5.34158C16.8268 4.98786 17.3204 4.89545 17.7 5.12758Z"
                                        stroke="rgb(30 64 175)" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12.033 7.61865C12.4472 7.61865 12.783 7.28287 12.783 6.86865C12.783 6.45444 12.4472 6.11865 12.033 6.11865V7.61865ZM9.23301 6.86865V6.11865L9.23121 6.11865L9.23301 6.86865ZM5.50001 10.6187H6.25001L6.25001 10.617L5.50001 10.6187ZM5.50001 16.2437L6.25001 16.2453V16.2437H5.50001ZM9.23301 19.9937L9.23121 20.7437H9.23301V19.9937ZM14.833 19.9937V20.7437L14.8348 20.7437L14.833 19.9937ZM18.566 16.2437H17.816L17.816 16.2453L18.566 16.2437ZM19.316 12.4937C19.316 12.0794 18.9802 11.7437 18.566 11.7437C18.1518 11.7437 17.816 12.0794 17.816 12.4937H19.316ZM15.8863 6.68446C15.7282 6.30159 15.2897 6.11934 14.9068 6.2774C14.5239 6.43546 14.3417 6.87397 14.4998 7.25684L15.8863 6.68446ZM18.2319 9.62197C18.6363 9.53257 18.8917 9.13222 18.8023 8.72777C18.7129 8.32332 18.3126 8.06792 17.9081 8.15733L18.2319 9.62197ZM8.30001 16.4317C7.8858 16.4317 7.55001 16.7674 7.55001 17.1817C7.55001 17.5959 7.8858 17.9317 8.30001 17.9317V16.4317ZM15.767 17.9317C16.1812 17.9317 16.517 17.5959 16.517 17.1817C16.517 16.7674 16.1812 16.4317 15.767 16.4317V17.9317ZM12.033 6.11865H9.23301V7.61865H12.033V6.11865ZM9.23121 6.11865C6.75081 6.12461 4.7447 8.13986 4.75001 10.6203L6.25001 10.617C6.24647 8.96492 7.58269 7.62262 9.23481 7.61865L9.23121 6.11865ZM4.75001 10.6187V16.2437H6.25001V10.6187H4.75001ZM4.75001 16.242C4.7447 18.7224 6.75081 20.7377 9.23121 20.7437L9.23481 19.2437C7.58269 19.2397 6.24647 17.8974 6.25001 16.2453L4.75001 16.242ZM9.23301 20.7437H14.833V19.2437H9.23301V20.7437ZM14.8348 20.7437C17.3152 20.7377 19.3213 18.7224 19.316 16.242L17.816 16.2453C17.8195 17.8974 16.4833 19.2397 14.8312 19.2437L14.8348 20.7437ZM19.316 16.2437V12.4937H17.816V16.2437H19.316ZM14.4998 7.25684C14.6947 7.72897 15.0923 8.39815 15.6866 8.91521C16.2944 9.44412 17.1679 9.85718 18.2319 9.62197L17.9081 8.15733C17.4431 8.26012 17.0391 8.10369 16.6712 7.7836C16.2897 7.45165 16.0134 6.99233 15.8863 6.68446L14.4998 7.25684ZM8.30001 17.9317H15.767V16.4317H8.30001V17.9317Z"
                                        fill="rgb(30 64 175)"></path>
                                </g>
                            </svg>
                        </a>
                        @if ($quiz->tenant?->hasActiveSubscription())
                            <a wire:click="delete('{{ $quiz->id }}')"
                                wire:confirm="Are you sure you want to delete this post?">
                                <svg height="25px" width="25px" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 511.998 511.998" xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <polygon style="fill:#F4B2B0;"
                                            points="178.652,462.067 110.276,462.067 82.918,106.177 178.652,106.177 ">
                                        </polygon>
                                        <path style="fill:#B3404A;"
                                            d="M311.198,70.475c-8.484,0-15.365-6.88-15.365-15.365V30.73H189.232V55.11 c0,8.484-6.88,15.365-15.365,15.365s-15.365-6.88-15.365-15.365V15.365C158.503,6.88,165.383,0,173.867,0h137.331 c8.484,0,15.365,6.88,15.365,15.365V55.11C326.563,63.596,319.684,70.475,311.198,70.475z">
                                        </path>
                                        <path style="fill:#F4B2B0;"
                                            d="M380.052,319.948l16.391-213.769H300.71v267.369C313.965,342.592,344.435,320.72,380.052,319.948z">
                                        </path>
                                        <g>
                                            <path style="fill:#B3404A;"
                                                d="M470.304,392.923c-8.484,0-15.365,6.88-15.365,15.365c0,40.242-32.741,72.983-72.983,72.983 c-40.243,0-72.984-32.741-72.984-72.983c0-34.479,24.522-63.845,57.028-71.208c0.011-0.002,0.02-0.005,0.031-0.006 c2.303-0.521,4.645-0.93,7.022-1.223c0.048-0.006,0.095-0.011,0.143-0.017c1.119-0.135,2.245-0.244,3.377-0.329 c0.081-0.006,0.164-0.014,0.246-0.018c1.183-0.083,2.374-0.14,3.571-0.166c8.077-0.171,14.554-6.544,15.005-14.475l15.282-199.302 h26.991c8.484,0,15.365-6.88,15.365-15.365s-6.88-15.365-15.365-15.365h-41.224h-95.735H178.652H82.918H41.695 c-8.484,0-15.365,6.88-15.365,15.365s6.88,15.365,15.365,15.365h26.994l26.268,341.704c0.615,8.005,7.291,14.186,15.32,14.186 h68.376h47.866c8.484,0,15.365-6.88,15.365-15.365c0-8.484-6.88-15.365-15.365-15.365h-32.501V121.542h91.327v248.965 c-4.648,11.891-7.103,24.653-7.103,37.779c0,57.188,46.526,103.712,103.714,103.712s103.712-46.525,103.712-103.712 C485.669,399.802,478.788,392.923,470.304,392.923z M316.075,121.542h63.782l-14.131,184.302c-0.069,0.011-0.137,0.026-0.206,0.035 c-0.931,0.147-1.856,0.32-2.781,0.492c-0.273,0.052-0.545,0.103-0.817,0.158c-16.835,3.283-32.529,10.675-45.846,21.666V121.542 H316.075z M163.287,446.703h-38.782L99.509,121.542h63.779v325.161H163.287z">
                                            </path>
                                            <path style="fill:#B3404A;"
                                                d="M403.685,408.297l7.968-7.968c6-6,6-15.729,0-21.73c-6.001-5.998-15.727-5.998-21.73,0l-7.968,7.968 l-7.968-7.968c-5.998-5.995-15.724-5.998-21.73,0c-6,6-6,15.729,0,21.73l7.968,7.968l-7.968,7.968c-6,6-6,15.729,0,21.73 c3.001,2.999,6.933,4.5,10.864,4.5c3.932,0,7.864-1.501,10.864-4.5l7.968-7.968l7.968,7.968c3.001,2.999,6.933,4.5,10.864,4.5 c3.932,0,7.864-1.501,10.864-4.5c6-6,6-15.729,0-21.73L403.685,408.297z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        @endif
                        <button class="relative" x-data="{ show: false }" x-on:click="show = true">
                            <svg width="20px" height="20px" viewBox="0 0 1024.00 1024.00" class="icon"
                                version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"
                                stroke-width="43.007999999999996">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M811.3 938.7H217.5c-71.5 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h296.9c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7H217.5c-24.5 0-44.4 19.9-44.4 44.4v593.8c0 24.5 19.9 44.4 44.4 44.4h593.8c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7S941 488.4 941 512v296.9c0 71.6-58.2 129.8-129.7 129.8z"
                                        fill="#3688FF"></path>
                                    <path
                                        d="M898.4 405.3c-23.6 0-42.7-19.1-42.7-42.7V212.9c0-23.3-19-42.3-42.3-42.3H663.7c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h149.7c70.4 0 127.6 57.2 127.6 127.6v149.7c0 23.7-19.1 42.8-42.6 42.8z"
                                        fill="#5F6379"></path>
                                    <path
                                        d="M373.6 712.6c-10.9 0-21.8-4.2-30.2-12.5-16.7-16.7-16.7-43.7 0-60.3L851.2 132c16.7-16.7 43.7-16.7 60.3 0 16.7 16.7 16.7 43.7 0 60.3L403.8 700.1c-8.4 8.3-19.3 12.5-30.2 12.5z"
                                        fill="#5F6379"></path>
                                </g>
                            </svg>

                            <div x-show="show" x-on:click.outside="show = false"
                                class="absolute right-0 z-10 w-48 p-2 bg-white border border-indigo-400 shadow-md cursor-default top-full">
                                <header class="flex justify-between">
                                    <h3 class="text-sm font-bold text-indigo-600">Copy Link</h3>
                                    <svg x-on:click="
                                    $refs.copyText.select()
                                    navigator.clipboard.writeText($refs.copyText.value)
                                    "
                                        class="cursor-pointer" width="18px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M6.59961 11.3974C6.59961 8.67119 6.59961 7.3081 7.44314 6.46118C8.28667 5.61426 9.64432 5.61426 12.3596 5.61426H15.2396C17.9549 5.61426 19.3125 5.61426 20.1561 6.46118C20.9996 7.3081 20.9996 8.6712 20.9996 11.3974V16.2167C20.9996 18.9429 20.9996 20.306 20.1561 21.1529C19.3125 21.9998 17.9549 21.9998 15.2396 21.9998H12.3596C9.64432 21.9998 8.28667 21.9998 7.44314 21.1529C6.59961 20.306 6.59961 18.9429 6.59961 16.2167V11.3974Z"
                                                fill="#1C274C"></path>
                                            <path opacity="0.5"
                                                d="M4.17157 3.17157C3 4.34315 3 6.22876 3 10V12C3 15.7712 3 17.6569 4.17157 18.8284C4.78913 19.446 5.6051 19.738 6.79105 19.8761C6.59961 19.0353 6.59961 17.8796 6.59961 16.2167V11.3974C6.59961 8.6712 6.59961 7.3081 7.44314 6.46118C8.28667 5.61426 9.64432 5.61426 12.3596 5.61426H15.2396C16.8915 5.61426 18.0409 5.61426 18.8777 5.80494C18.7403 4.61146 18.4484 3.79154 17.8284 3.17157C16.6569 2 14.7712 2 11 2C7.22876 2 5.34315 2 4.17157 3.17157Z"
                                                fill="#1C274C"></path>
                                        </g>
                                    </svg>
                                </header>
                                <input x-ref="copyText" type="text" readonly
                                    value="{{ route('user.quizzes.show', $quiz->id) }}"
                                    class="w-full h-5 text-xs truncate rounded">
                            </div>
                        </button>
                    </div>
                    <a target="_blank" href="{{ route('user.quizzes.show', $quiz->id) }}"
                        class="flex flex-col gap-2 p-4">
                        <div>

                            @if ($quiz->hasExpired())
                                <span
                                    class="px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full shadow-sm w-fit me-2 dark:bg-blue-900 dark:text-blue-300">Expired</span>
                            @endif

                            @if ($quiz->isAvailable())
                                <span
                                    class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full shadow-sm w-fit me-2 dark:bg-green-900 dark:text-green-300">Available</span>
                            @endif

                            <span
                                class="px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full shadow-sm w-fit me-2 dark:bg-purple-900 dark:text-purple-300">{{ $quiz->isPublic() ? 'Public' : 'Private' }}</span>

                        </div>

                        <div>
                            <p class="max-w-full text-xl font-semibold truncate text-stone-500 dark:text-white">
                                {{ $quiz->title }}
                            </p>
                            <p class="max-w-full text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ $quiz->description ?: 'Said nothing about this quiz' }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-sm font-bold text-emerald-700 dark:text-white">
                                Total: {{ $quiz->marks_total }}
                            </div>
                            <div class="text-xs font-bold text-slate-500">{{ $quiz->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </li>

            @empty
                <x-no-content />
            @endforelse

        </ul>
        @if ($quizzes->isNotEmpty())
            <div class="bg-white p-5 max-w-4xl !mt-6 m-auto border-t border-t-gray-300">
                {{ $quizzes->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>
