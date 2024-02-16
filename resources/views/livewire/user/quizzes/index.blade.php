<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Your Quizzes') }}
            </h2>
            <a href="{{ route('user.quizzes.create') }}"
                class="relative px-5 py-1 text-white bg-indigo-600 rounded-md text-md hover:bg-indigo-500 focus:ring-2 ring-indigo-600 ring-offset-2 disabled:opacity-50">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="p-5 m-auto max-w-4xl">
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
            <x-no-content />
            @endforelse

        </ul>
        @if ($quizzes->isNotEmpty())
        <div class="my-3">
            {{ $quizzes->links() }}
        </div>
        @endif
    </div>
</div>