<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Your Quizzes') }}
        </h2>
    </x-slot>

    <div class="p-5 m-auto max-w-6xl">
        <ul
            class="grid gap-3 grid-cols-[repeat(auto-fit,_minmax(280px,_1fr))] sm:grid-cols-[repeat(2,_minmax(300px,_1fr))] *:rounded-md *:shadow-lg *:border *:bg-white *:transition-all">
            @forelse ($quizzes as $quiz)

            <li class="{{ $quiz->isPrivate() ? 'border-amber-500 !bg-amber-50' : 'border-blue-500' }} hover:shadow-sm">
                <a class="flex flex-col p-4 gap-2">
                    <div>
                        <p class="text-xl font-semibold truncate text-stone-500 dark:text-white max-w-full">
                            {{ $quiz->title }}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400 max-w-full">
                            {{ $quiz->description ?: 'Said nothing about this quiz' }}
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <div class="text-sm font-bold text-emerald-700 dark:text-white">
                            Total: {{ $quiz->marks_total }}
                        </div>
                        <div class="text-xs text-slate-500 font-bold">{{ $quiz->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
            </li>

            @empty
            <li
                class="p-3 flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2/3 bg-white border-none min-h-40 *:bg-gray-100">
                <div class=" flex-1 p-4 flex items-center justify-center">
                    No Content
                </div>
            </li>
            @endforelse

        </ul>
        @if ($quizzes->isNotEmpty())
        <div class="my-3">
            {{ $quizzes->links() }}
        </div>
        @endif
    </div>
</div>
