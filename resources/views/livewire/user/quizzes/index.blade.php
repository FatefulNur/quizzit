<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Your Quizzes') }}
            </h2>
            <a href="{{ route('user.quizzes.create') }}"
                wire:navigate
                class="relative px-5 py-1 text-white bg-indigo-600 rounded-md text-md hover:bg-indigo-500 focus:ring-2 ring-indigo-600 ring-offset-2 disabled:opacity-50">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl p-5 m-auto">
        @if ($quizzes->count())

        <div class="flex flex-row-reverse items-center justify-start gap-4 mb-3 text-right">
            <select wire:model.live="date" class="border-none rounded-lg outline-none ring-2 ring-slate-600" name="date"
                id="date">
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

        @endif

        <ul
            class="grid gap-3 grid-cols-[repeat(auto-fit,_minmax(280px,_1fr))] sm:grid-cols-[repeat(2,_minmax(300px,_1fr))] *:rounded-md *:shadow-lg *:border *:bg-white *:transition-all">
            @forelse ($quizzes as $quiz)

            <li class="group relative {{ $quiz->isPrivate() ? 'border-amber-500 !bg-amber-50' : 'border-blue-500' }} hover:shadow-sm">
                <div class="absolute hidden gap-2 px-2 py-1 group-hover:flex -right-1 -top-1">
                    <a class="" href="{{ route('user.quizzes.edit', $quiz->id) }}">
                        <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7 5.12758L19.266 6.37458C19.4172 6.51691 19.5025 6.71571 19.5013 6.92339C19.5002 7.13106 19.4128 7.32892 19.26 7.46958L18.07 8.89358L14.021 13.7226C13.9501 13.8037 13.8558 13.8607 13.751 13.8856L11.651 14.3616C11.3755 14.3754 11.1356 14.1751 11.1 13.9016V11.7436C11.1071 11.6395 11.149 11.5409 11.219 11.4636L15.193 6.97058L16.557 5.34158C16.8268 4.98786 17.3204 4.89545 17.7 5.12758Z" stroke="rgb(30 64 175)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.033 7.61865C12.4472 7.61865 12.783 7.28287 12.783 6.86865C12.783 6.45444 12.4472 6.11865 12.033 6.11865V7.61865ZM9.23301 6.86865V6.11865L9.23121 6.11865L9.23301 6.86865ZM5.50001 10.6187H6.25001L6.25001 10.617L5.50001 10.6187ZM5.50001 16.2437L6.25001 16.2453V16.2437H5.50001ZM9.23301 19.9937L9.23121 20.7437H9.23301V19.9937ZM14.833 19.9937V20.7437L14.8348 20.7437L14.833 19.9937ZM18.566 16.2437H17.816L17.816 16.2453L18.566 16.2437ZM19.316 12.4937C19.316 12.0794 18.9802 11.7437 18.566 11.7437C18.1518 11.7437 17.816 12.0794 17.816 12.4937H19.316ZM15.8863 6.68446C15.7282 6.30159 15.2897 6.11934 14.9068 6.2774C14.5239 6.43546 14.3417 6.87397 14.4998 7.25684L15.8863 6.68446ZM18.2319 9.62197C18.6363 9.53257 18.8917 9.13222 18.8023 8.72777C18.7129 8.32332 18.3126 8.06792 17.9081 8.15733L18.2319 9.62197ZM8.30001 16.4317C7.8858 16.4317 7.55001 16.7674 7.55001 17.1817C7.55001 17.5959 7.8858 17.9317 8.30001 17.9317V16.4317ZM15.767 17.9317C16.1812 17.9317 16.517 17.5959 16.517 17.1817C16.517 16.7674 16.1812 16.4317 15.767 16.4317V17.9317ZM12.033 6.11865H9.23301V7.61865H12.033V6.11865ZM9.23121 6.11865C6.75081 6.12461 4.7447 8.13986 4.75001 10.6203L6.25001 10.617C6.24647 8.96492 7.58269 7.62262 9.23481 7.61865L9.23121 6.11865ZM4.75001 10.6187V16.2437H6.25001V10.6187H4.75001ZM4.75001 16.242C4.7447 18.7224 6.75081 20.7377 9.23121 20.7437L9.23481 19.2437C7.58269 19.2397 6.24647 17.8974 6.25001 16.2453L4.75001 16.242ZM9.23301 20.7437H14.833V19.2437H9.23301V20.7437ZM14.8348 20.7437C17.3152 20.7377 19.3213 18.7224 19.316 16.242L17.816 16.2453C17.8195 17.8974 16.4833 19.2397 14.8312 19.2437L14.8348 20.7437ZM19.316 16.2437V12.4937H17.816V16.2437H19.316ZM14.4998 7.25684C14.6947 7.72897 15.0923 8.39815 15.6866 8.91521C16.2944 9.44412 17.1679 9.85718 18.2319 9.62197L17.9081 8.15733C17.4431 8.26012 17.0391 8.10369 16.6712 7.7836C16.2897 7.45165 16.0134 6.99233 15.8863 6.68446L14.4998 7.25684ZM8.30001 17.9317H15.767V16.4317H8.30001V17.9317Z" fill="rgb(30 64 175)"></path> </g></svg>
                    </a>
                </div>
                <a href="{{ route('user.quizzes.show', $quiz->id) }}" class="flex flex-col gap-2 p-4">
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
                            class="px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full shadow-sm w-fit me-2 dark:bg-purple-900 dark:text-purple-300">{{
                            $quiz->isPublic() ? 'Public' : 'Private' }}</span>

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
