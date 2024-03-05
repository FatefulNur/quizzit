<div>

    @if ($response->quiz)

        <div class="py-12">
            {{-- ====================Quiz Informations======================= --}}
            {{-- ====================*****************======================= --}}
            {{-- ====================*****************======================= --}}
            <div
                class="relative flex flex-col p-4 space-y-3 bg-white border border-t-8 rounded-md shadow sm:p-8 border-slate-300 dark:bg-gray-800 sm:rounded-lg border-t-indigo-600">

                @if ($response->quiz->marks_total)
                    <div class="absolute text-lg font-bold text-right text-indigo-500 top-2 right-2">
                        Result: <span
                            class="px-2 py-1 text-sm text-white bg-indigo-500 rounded-full">{{ $response->result }}</span>
                    </div>
                @endif

                <h1 class="text-2xl font-bold tracking-tight text-center sm:text-3xl text-stone-500">
                    {{ $response->quiz?->title }}
                </h1>

                <p class="tracking-tight text-center text-gray-500 text-md">{{ $response->quiz?->description }}</p>
            </div>
        </div>

        {{-- ======================Questions=========================== --}}
        {{-- ====================*************======================= --}}
        {{-- ====================*************======================= --}}

        <form wire:submit="save" class="space-y-4">
            @foreach ($response->quiz?->questions as $questionKey => $question)
                <div @class([
                    'relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3',
                    '!bg-green-50' =>
                        $response->hasCorrectAnswer($question->id) && $question->isMCQ(),
                    '!bg-red-50' =>
                        !$response->hasCorrectAnswer($question->id) && $question->isMCQ(),
                ]) wire:key="{{ $questionKey }}">

                    @if ($response->quiz->marks_total)
                        <div class="text-right">
                            <span
                                class="absolute px-2 py-1 ml-auto text-sm text-center text-white bg-indigo-500 rounded-full min-w-6 top-2 right-2">{{ $question->marks }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between gap-5">
                        <div class="flex-1 text-lg font-bold tracking-tight sm:text-xl text-stone-600">
                            {{ $question->title }}
                        </div>
                    </div>

                    @if ($question->isShortText())
                        <div class="w-full border-b border-indigo-500">
                            <label
                                class="inline-block w-full h-8 p-2 px-0 text-sm font-bold border-0 text-stone-500 bg-gray-50 focus:shadow-none outline-0">{{ $response->getFirstQuestionAnswer($question->id) }}</label>
                        </div>
                    @elseif ($question->isLongText())
                        <div class="w-full border-b border-indigo-500">
                            <label
                                class="inline-block w-full h-12 p-2 px-0 text-sm font-bold border-0 text-stone-500 bg-gray-50 focus:shadow-none outline-0">{{ $response->getFirstQuestionAnswer($question->id) }}</label>
                        </div>
                    @elseif($question->isRadio())
                        @if ($question->options()->count())
                            <div
                                class="grid gap-2 *:pb-2 *:inline-block *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7">

                                @foreach ($question->options as $optionKey => $option)
                                    <div wire:key="{{ $optionKey }}">

                                        <div class="flex items-center h-8 me-4">

                                            <label @class([
                                                'inline-block w-full h-8 px-0 text-sm leading-8 text-gray-800 border-0 border-b-2 cursor-pointer bg-gray-50 focus:shadow-none outline-0',
                                                'border-indigo-600' => $response->hasSelectedOption($option->id),
                                                'bg-lime-200' => $response->hasAnyCorrectOptions($question, $option->id),
                                                'bg-red-200' =>
                                                    $response->hasSelectedOption($option->id) &&
                                                    !$response->hasCorrectOption($option->id),
                                            ])>

                                                <span @class([
                                                    'relative inline-block w-4 h-4 mr-1 align-middle bg-gray-100 border border-gray-300 rounded-full',
                                                    'border-indigo-600' => $response->hasSelectedOption($option->id),
                                                ])>
                                                    @if ($response->hasSelectedOption($option->id))
                                                        <span
                                                            class="absolute top-[1px] left-[1px] bottom-[1px] right-[1px] bg-indigo-500 rounded-full"></span>
                                                    @endif
                                                </span>

                                                {{ $option->label }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <span class="inline-block text-sm text-orange-600">No Options are available</span>
                        @endif
                    @else
                        @if ($question->options()->count())
                            <div
                                class="grid gap-2 *:pb-2 *:inline-block *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7">

                                @foreach ($question->options as $optionKey => $option)
                                    <div wire:key="{{ $optionKey }}">
                                        <div class="flex items-center h-8 me-4">

                                            <label @class([
                                                'inline-block w-full h-8 px-0 text-sm leading-8 text-gray-800 border-0 border-b-2 cursor-pointer bg-gray-50 focus:shadow-none outline-0',
                                                'border-indigo-600' => $response->hasSelectedOption($option->id),
                                                'bg-lime-200' => $response->hasAnyCorrectOptions($question, $option->id),
                                                'bg-red-200' =>
                                                    $response->hasSelectedOption($option->id) &&
                                                    !$response->hasCorrectOption($option->id),
                                            ])>

                                                <span @class([
                                                    'relative inline-block w-4 h-4 mr-1 align-middle bg-gray-100 border border-gray-300 rounded-sm',
                                                    'border-indigo-600' => $response->hasSelectedOption($option->id),
                                                ])>
                                                    @if ($response->hasSelectedOption($option->id))
                                                        <span
                                                            class="absolute top-[1px] left-[1px] bottom-[1px] right-[1px] bg-indigo-500"></span>
                                                    @endif
                                                </span>

                                                {{ $option->label }}

                                            </label>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <span class="inline-block text-sm text-orange-600">No Options are available</span>
                        @endif
                    @endif

                    @if ($question->hint)
                        <div class="p-2 text-sm text-yellow-800 bg-yellow-100 border-l-2 border-l-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
                            role="alert">
                            {{ $question->hint }}
                        </div>
                    @endif

                    @if ($response->quiz->marks_total && $response->hasCorrectAnswer($question->id) && $question->isMCQ())
                        <div class="p-2 text-sm border-l-2 text-lime-800 bg-lime-100 border-l-lime-800 dark:bg-gray-800 dark:text-lime-300"
                            role="alert">
                            Considered as correct answer.
                        </div>
                    @elseif($response->quiz->marks_total && !$response->hasCorrectAnswer($question->id) && $question->isMCQ())
                        <div class="p-2 text-sm text-red-800 bg-red-100 border-l-2 border-l-red-800 dark:bg-gray-800 dark:text-red-300"
                            role="alert">
                            Sorry! your answer isn't correct.
                        </div>
                    @endif

                </div>
            @endforeach
        </form>
    @else
        <x-no-content />
    @endif
</div>
