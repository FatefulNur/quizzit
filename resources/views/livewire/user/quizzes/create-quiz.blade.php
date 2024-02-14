<form wire:submit="save">
    <header class="sticky z-40 bg-white shadow dark:bg-gray-800 -top-2">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Create new Quiz') }}
                </h2>

                <div class="flex gap-3 shrink">
                    <div class="flex items-center justify-between">
                        <label for="quiz_type"
                            class="mr-1 text-sm font-medium text-gray-900 cursor-pointer ms-3 dark:text-gray-300">Private?</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input id="quiz_type" type="checkbox" class="sr-only peer">
                            <div
                                class="w-9 h-5 shadow-sm bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                            </div>
                        </label>
                    </div>

                    {{-- ====================Submit Button======================= --}}
                    {{-- ====================*************======================= --}}
                    {{-- ====================*************======================= --}}
                    <button type="submit"
                        class="relative px-5 py-1 text-white bg-indigo-600 rounded-md text-md hover:bg-indigo-500 focus:ring-2 ring-indigo-600 ring-offset-2 disabled:opacity-50">
                        Save <span wire:loading.inline-flex wire:target="save"
                            class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center animate-spin">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="#915f5f">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M12 3C10.22 3 8.47991 3.52784 6.99987 4.51677C5.51983 5.50571 4.36628 6.91131 3.68509 8.55585C3.0039 10.2004 2.82567 12.01 3.17294 13.7558C3.5202 15.5016 4.37737 17.1053 5.63604 18.364C6.89472 19.6226 8.49836 20.4798 10.2442 20.8271C11.99 21.1743 13.7996 20.9961 15.4442 20.3149C17.0887 19.6337 18.4943 18.4802 19.4832 17.0001C20.4722 15.5201 21 13.78 21 12"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M19.7942 7.5C19.8905 7.66673 19.9813 7.83651 20.0667 8.00907"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"></path>
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="py-12 space-y-8">
        <div class="max-w-4xl mx-auto space-y-6 sm:px-6 lg:px-8">

            {{-- ====================Expire Date Field======================= --}}
            {{-- ====================*****************======================= --}}
            {{-- ====================*****************======================= --}}
            <div class="flex-1 space-y-1 text-right">
                <label class="inline-flex items-center gap-1 p-2 text-sm font-semibold text-gray-500 bg-white rounded-md shadow-md cursor-pointer border @error('expired_at')
                        border-red-500
                    @enderror">
                    <svg width="25px" height="25px" viewBox="-0.5 0 15 15" xmlns="http://www.w3.org/2000/svg"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill="#000000" fill-rule="evenodd"
                                d="M107,154.006845 C107,153.45078 107.449949,153 108.006845,153 L119.993155,153 C120.54922,153 121,153.449949 121,154.006845 L121,165.993155 C121,166.54922 120.550051,167 119.993155,167 L108.006845,167 C107.45078,167 107,166.550051 107,165.993155 L107,154.006845 Z M108,157 L120,157 L120,166 L108,166 L108,157 Z M116.5,163.5 L116.5,159.5 L115.757485,159.5 L114.5,160.765367 L114.98503,161.275112 L115.649701,160.597451 L115.649701,163.5 L116.5,163.5 Z M112.5,163.5 C113.412548,163.5 114,163.029753 114,162.362119 C114,161.781567 113.498099,161.473875 113.110266,161.433237 C113.532319,161.357765 113.942966,161.038462 113.942966,160.550798 C113.942966,159.906386 113.395437,159.5 112.505703,159.5 C111.838403,159.5 111.359316,159.761248 111.051331,160.115385 L111.456274,160.632075 C111.724335,160.370827 112.055133,160.231495 112.425856,160.231495 C112.819392,160.231495 113.13308,160.382438 113.13308,160.690131 C113.13308,160.974601 112.847909,161.102322 112.425856,161.102322 C112.28327,161.102322 112.020913,161.102322 111.952471,161.096517 L111.952471,161.839623 C112.009506,161.833817 112.26616,161.828012 112.425856,161.828012 C112.956274,161.828012 113.190114,161.967344 113.190114,162.275036 C113.190114,162.565312 112.93346,162.768505 112.471483,162.768505 C112.10076,162.768505 111.684411,162.605951 111.427757,162.327286 L111,162.87881 C111.279468,163.227141 111.804183,163.5 112.5,163.5 Z M110,152.5 C110,152.223858 110.214035,152 110.504684,152 L111.495316,152 C111.774045,152 112,152.231934 112,152.5 L112,153 L110,153 L110,152.5 Z M116,152.5 C116,152.223858 116.214035,152 116.504684,152 L117.495316,152 C117.774045,152 118,152.231934 118,152.5 L118,153 L116,153 L116,152.5 Z"
                                transform="translate(-107 -152)"></path>
                        </g>
                    </svg>

                    <input wire:model="expired_at" class="w-0 p-0 border-none" type="text" name="expired_at"
                        id="expired_at" style="box-shadow: none" data-picker>
                    Expiration Date
                </label>
                @error('expired_at')
                <x-input-error :messages="$message" />
                @enderror
            </div>

            {{-- ====================Quiz Form======================= --}}
            {{-- ====================*********======================= --}}
            {{-- ====================*********======================= --}}
            <div
                class="flex flex-col p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3">

                <x-question.text-input wire:model="title" class="text-2xl" name="quiz_title"
                    :error="$errors?->first('title')" placeholder="Quiz Heading" />
                @error('title')
                <x-input-error :messages="$message" />
                @enderror

                <x-question.textarea wire:model="description" name="description" :error="$errors?->first('description')"
                    placeholder="Say more about this quiz!" />
                @error('description')
                <x-input-error :messages="$message" />
                @enderror
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto space-y-6 sm:px-6 lg:px-8">

        {{-- ====================Question Form======================= --}}
        {{-- ====================*************======================= --}}
        {{-- ====================*************======================= --}}
        <div class="space-y-4" x-data>

            @foreach ($questions as $questionKey => $question)

            <div class="relative group" wire:key="{{ $questionKey }}">

                @if (count($questions) > 1)

                <button x-on:click="$el.parentNode.remove()" wire:click="removeQuestion({{ $questionKey }})"
                    type="button"
                    class="absolute z-30 invisible inline-block text-2xl font-bold leading-6 text-red-600 transition bg-white border rounded-full shadow-md -top-1 -right-1 w-7 h-7 group-hover:visible">&times;</button>

                @endif

                <div class="relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3"
                    x-data='{questionType: ""}' x-modelable="questionType"
                    wire:model="questions.{{ $questionKey }}.type">
                    <div>
                        <div class="relative inline-block w-[70px]">
                            <input wire:model="questions.{{ $questionKey }}.marks" min="1" type="number" name="marks"
                                id="marks" placeholder="Marks"
                                class="w-full h-12 px-0 text-center border-0 text-md bg-gray-50 focus:shadow-none outline-0 peer"
                                style="box-shadow: none" autocomplete="off">
                            <div
                                class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                            </div>
                            <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10">
                            </div>
                        </div>
                        @error("questions.$questionKey.marks")
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex justify-between gap-5">
                        <div class="flex-1">
                            <x-question.text-input wire:model="questions.{{ $questionKey }}.title" class="text-2xl"
                                name="question_title" :error="$errors?->first('questions.'.$questionKey.'.title')"
                                placeholder="Ask a question?" />
                            @error("questions.$questionKey.title")
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex-1">

                            <x-question.select wire:model="questions.{{ $questionKey }}.type"
                                wire:change="resetOptions({{ $questionKey }})" :items="App\Enums\QuestionType::cases()"
                                :error="$errors?->first('questions.'.$questionKey.'.type')" />
                            @error("questions.$questionKey.type")
                            <x-input-error :messages="$message" />
                            @enderror

                        </div>
                    </div>

                    <div>
                        <x-question.textarea wire:model="questions.{{ $questionKey }}.hint" name="hint"
                            :error="$errors?->first('questions.'.$questionKey.'.hint')"
                            placeholder="Want to set any clue?" />
                        @error("questions.$questionKey.hint")
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    {{-- ====================Short Text Option================== --}}
                    {{-- ====================*****************================== --}}
                    <template x-if="questionType === 'short_text'">
                        <div class="flex-1 p-3 space-y-4 text-stone-600">
                            <div class="w-1/2 border-b border-slate-500">
                                <label
                                    class="inline-block w-full h-8 px-0 text-sm text-gray-800 border-0 bg-gray-50 focus:shadow-none outline-0">Short
                                    Text</label>
                            </div>

                            <label class="inline-block font-semibold text-indigo-500 cursor-pointer text-md peer">
                                Set an Answer
                                <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
                            </label>

                            <div class="hidden peer-has-[:checked]:block">
                                @foreach ($question['options'] as $optionKey => $option)

                                <div class="relative w-1/2" wire:key="{{ $optionKey }}" x-data="{isChecked: false}"
                                    x-modelable="isChecked"
                                    wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.is_correct">
                                    <input type="checkbox" name="option" x-model="isChecked" class="hidden" hidden />
                                    <x-question.text-input
                                        x-on:input="isChecked = $event.target.value.trim().length ? true: false"
                                        wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.label"
                                        name="label"
                                        :error="$errors?->first('questions.'.$questionKey.'.options.'.$optionKey.'.label')"
                                        placeholder="e.g. answer1, answer2" />
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </template>


                    {{-- ====================Long Text Option================== --}}
                    {{-- ====================****************================== --}}
                    <template x-if="questionType === 'long_text'">
                        <div class="flex-1 p-3 space-y-4 text-stone-600">
                            <div class="w-1/2 border-b border-slate-500">
                                <label
                                    class="inline-block w-full h-8 px-0 text-sm text-gray-800 border-0 bg-gray-50 focus:shadow-none outline-0">Long
                                    Text</label>
                            </div>

                            <label class="inline-block font-semibold text-indigo-500 cursor-pointer text-md peer">
                                Set an Answer
                                <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
                            </label>

                            @foreach ($question['options'] as $optionKey => $option)

                            <div class="hidden peer-has-[:checked]:block" wire:key="{{ $optionKey }}"
                                x-data="{isChecked: false}" x-modelable="isChecked"
                                wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.is_correct">
                                <input type="checkbox" name="option" x-model="isChecked" class="hidden" hidden />
                                <x-question.textarea
                                    x-on:input="isChecked = $event.target.value.trim().length ? true: false"
                                    wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.label"
                                    name="answer_text"
                                    :error="$errors?->first('questions.'.$questionKey.'.options.'.$optionKey.'.label')"
                                    placeholder="e.g. answer1, answer2" />
                            </div>

                            @endforeach
                        </div>

                    </template>

                    {{-- ====================Radio Option================== --}}
                    {{-- ====================************================== --}}
                    <template x-if="questionType === 'radio'">

                        <div class="flex-1 p-3 space-y-4 text-stone-600">
                            <label class="inline-block font-semibold text-indigo-500 cursor-pointer text-md peer">
                                Set Options
                                <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
                            </label>

                            <div class="hidden peer-has-[:checked]:block">
                                <p class="mb-1 text-sm font-bold text-gray-400">Set correct answers by checking the
                                    options.</p>

                                <div class="space-y-2">
                                    @foreach ($question['options'] as $optionKey => $option)

                                    <div class="relative flex items-center w-2/5 h-8 gap-2 me-4 bg-gray-50"
                                        wire:key="{{ $optionKey }}">

                                        @if (count($question['options']) > 1)

                                        <button x-on:click="$el.parentNode.remove()"
                                            wire:click="removeOption({{ $questionKey }}, {{ $optionKey }})"
                                            type="button"
                                            class="absolute z-30 invisible inline-block text-2xl font-bold leading-6 text-red-600 transition bg-white border rounded-full shadow-md -top-1 -right-1 w-7 h-7 group-hover:visible">&times;</button>

                                        @endif

                                        <input
                                            wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.is_correct"
                                            id="option" type="checkbox" name="option"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                        <input wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.label"
                                            type="text" name="label_{{ $questionKey }}" id="label"
                                            placeholder="Set a label?"
                                            class="w-full h-8 p-0 border-0 text-md bg-gray-50 outline-0 peer"
                                            style="box-shadow: none" autocomplete="off">
                                        <div
                                            class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                                        </div>
                                        <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10">
                                        </div>
                                    </div>

                                    @endforeach

                                    <div class="flex items-center w-2/5 h-8 me-4"
                                        wire:click="addOption({{ $questionKey }})">
                                        <label
                                            class="inline-block w-full h-8 px-0 text-sm leading-8 text-gray-800 border-0 border-b-2 cursor-pointer bg-gray-50 focus:shadow-none outline-0">
                                            <span
                                                class="inline-block w-4 h-4 mr-1 align-middle bg-gray-100 border border-gray-300 rounded"></span>
                                            Add More Option
                                            <span wire:loading wire:target="addOption({{ $questionKey }})"
                                                class="text-sm font-semibold text-green-400 animate-pulse">Waiting...</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </template>


                    {{-- ====================Checkbox Option================== --}}
                    {{-- ====================***************================== --}}
                    <template x-if="questionType === 'checkbox'">

                        <div class="flex-1 p-3 space-y-4 text-stone-600">
                            <label class="inline-block font-semibold text-indigo-500 cursor-pointer text-md peer">
                                Set Options
                                <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
                            </label>

                            <div class="hidden peer-has-[:checked]:block">
                                <p class="mb-1 text-sm font-bold text-gray-400">Set correct answers by checking the
                                    options.</p>

                                <div class="space-y-2">
                                    @foreach ($question['options'] as $optionKey => $option)

                                    <div class="relative flex items-center w-2/5 h-8 gap-2 me-4 bg-gray-50"
                                        wire:key="{{ $optionKey }}">

                                        @if (count($question['options']) > 1)

                                        <button x-on:click="$el.parentNode.remove()"
                                            wire:click="removeOption({{ $questionKey }}, {{ $optionKey }})"
                                            type="button"
                                            class="absolute z-30 invisible inline-block text-2xl font-bold leading-6 text-red-600 transition bg-white border rounded-full shadow-md -top-1 -right-1 w-7 h-7 group-hover:visible">&times;</button>

                                        @endif

                                        <input
                                            wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.is_correct"
                                            id="option" type="checkbox" name="option"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                        <input wire:model="questions.{{ $questionKey }}.options.{{ $optionKey }}.label"
                                            type="text" name="label_{{ $questionKey }}" id="label"
                                            placeholder="Set a label?"
                                            class="w-full h-8 p-0 border-0 text-md bg-gray-50 outline-0 peer"
                                            style="box-shadow: none" autocomplete="off">
                                        <div
                                            class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                                        </div>
                                        <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10">
                                        </div>
                                    </div>

                                    @endforeach

                                    <div class="flex items-center w-2/5 h-8 me-4"
                                        wire:click="addOption({{ $questionKey }})">
                                        <label
                                            class="inline-block w-full h-8 px-0 text-sm leading-8 text-gray-800 border-0 border-b-2 cursor-pointer bg-gray-50 focus:shadow-none outline-0">
                                            <span
                                                class="inline-block w-4 h-4 mr-1 align-middle bg-gray-100 border border-gray-300 rounded"></span>
                                            Add More Option
                                            <span wire:loading wire:target="addOption({{ $questionKey }})"
                                                class="text-sm font-semibold text-green-400 animate-pulse">Waiting...</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </template>
                </div>
            </div>

            @endforeach

            {{-- ====================Add Question Floating Button================== --}}
            {{-- ====================****************************================== --}}
            {{-- ====================****************************================== --}}
            <button wire:loading.attr="disabled" wire:target="addQuestion" type="button" title="Add More Questions"
                wire:click="addQuestion()"
                class="fixed z-30 block w-12 h-12 px-1 text-3xl font-bold text-white transition bg-indigo-800 rounded-full bottom-5 right-5 leading-12 hover:bg-indigo-600 disabled:opacity-30">&plus;</button>
            <div x-ref="scrollToBottom"></div>
        </div>
    </div>
</form>

@assets
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endassets

@script
<script>
    const field = document.querySelector('[data-picker]');
        const picker = new Pikaday({
            field: field,
            position: 'bottom',
            format: 'MM/DD/YYYY',
            minDate: new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
            onSelect: function(date) {
                $wire.set('expired_at', date)
            }
        });
</script>
@endscript
