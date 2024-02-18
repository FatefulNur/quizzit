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

            <li class="{{ $quiz->isPrivate() ? 'border-amber-500 !bg-amber-50' : 'border-blue-500' }} hover:shadow-sm">
                <a class="flex flex-col gap-2 p-4">
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