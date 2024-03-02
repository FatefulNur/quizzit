<div>

    @if ($quiz?->questions()->count())

        <div class="py-12">
            {{-- ====================Quiz Informations======================= --}}
            {{-- ====================*****************======================= --}}
            {{-- ====================*****************======================= --}}
            <div
                class="relative flex flex-col p-4 space-y-3 bg-white border border-t-8 rounded-md shadow sm:p-8 border-slate-300 dark:bg-gray-800 sm:rounded-lg border-t-indigo-600">

                <div class="absolute text-lg font-bold text-right text-indigo-500 top-2 right-2">
                    Marks: <span
                        class="px-2 py-1 text-sm text-white bg-indigo-500 rounded-full">{{ $quiz->marks_total }}</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-center sm:text-3xl text-stone-500">
                    {{ $quiz->title }}
                </h1>

                <p class="tracking-tight text-center text-gray-500 text-md">{{ $quiz->description }}</p>
            </div>
        </div>

        {{-- ======================Questions=========================== --}}
        {{-- ====================*************======================= --}}
        {{-- ====================*************======================= --}}

        <form wire:submit="save" class="space-y-4">
            @foreach ($quiz->questions as $questionKey => $question)
                <div class="relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3"
                    wire:key="{{ $questionKey }}">

                    {{-- ================ Timer ==================== --}}
                    {{-- ==============***********================== --}}
                    {{-- =========================================== --}}
                    @if (!is_null($quiz->timer))
                        <div x-data="{
                            totalSeconds: {{ $quiz->timer }} * 60,
                            minutes: Math.floor({{ $quiz->timer }}),
                            seconds: 0,
                            startTimer() {
                                this.timerInterval = setInterval(() => {
                                    this.tick()
                                }, 1000)
                            },
                            tick() {
                                if (this.totalSeconds === 0) {
                                    clearInterval(this.timerInterval)
                        
                                    $wire.call('save')
                                    return
                                }
                                this.totalSeconds--;
                                this.minutes = Math.floor(this.totalSeconds / 60)
                                this.seconds = this.totalSeconds % 60
                            },
                            formatTime(time) {
                                return time < 10 ? '0' + time : time
                            }
                        }" x-init="startTimer()"
                            class="fixed flex top-4 right-4 p-2 bg-indigo-600 text-white shadow-lg min-w-20 justify-center text-xl rounded-md border-2 border-indigo-800">
                            <span x-text="formatTime(minutes)"></span>:
                            <span x-text="formatTime(seconds)"></span>
                        </div>
                    @endif


                    <div class="text-right">
                        <span
                            class="absolute px-2 py-1 ml-auto text-sm text-center text-white bg-indigo-500 rounded-full min-w-6 top-2 right-2">{{ $question->marks }}</span>
                    </div>

                    <div class="flex justify-between gap-5">
                        <div class="flex-1 text-lg font-bold tracking-tight sm:text-xl text-stone-600">
                            {{ $question->title }}
                        </div>
                    </div>

                    @if ($question->isShortText())
                        <input type="hidden" name="option_{{ $questionKey }}" id="option_{{ $questionKey }}"
                            x-init="$wire.set('answers.{{ $questionKey }}.option_id.0', '{{ $question->options->first()->id }}')" wire:model="answers.{{ $questionKey }}.option_id.0" hidden
                            class="hidden">

                        <x-question.text-input name="answer" :error="$errors?->first('answer')" placeholder="Your answer!"
                            wire:model="answers.{{ $questionKey }}.answer.0" />

                        @error("answers.$questionKey.answer")
                            <x-input-error :messages="$message" />
                        @enderror
                    @elseif ($question->isLongText())
                        <input type="hidden" name="option_{{ $questionKey }}" id="option_{{ $questionKey }}"
                            x-init="$wire.set('answers.{{ $questionKey }}.option_id.0', '{{ $question->options->first()->id }}')" wire:model="answers.{{ $questionKey }}.option_id.0" hidden
                            class="hidden">

                        <x-question.textarea name="answer" :error="$errors?->first('answer')" placeholder="Your answer!"
                            wire:model="answers.{{ $questionKey }}.answer.0" />

                        @error("answers.$questionKey.answer")
                            <x-input-error :messages="$message" />
                        @enderror
                    @elseif($question->isRadio())
                        @if ($question->options()->count())
                            @error("answers.$questionKey.answer")
                                <x-input-error :messages="$message" />
                            @enderror

                            <div class="grid gap-2 *:border-b *:pb-2 *:inline-block *:w-2/5 *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7"
                                x-data='{
                                    answers: [],
                                    setAnswer(isChecked, answer) {
                                        if(isChecked) {
                                            this.answers = []
                                            this.answers.push(answer)
                                        }
                                    }
                                }'>

                                @foreach ($question->options as $optionKey => $option)
                                    <div>
                                        <label>
                                            <input wire:loading.attr="disabled" wire:target="setAnswer"
                                                x-on:change="
                                    setAnswer($event.target.checked, '{{ $option->label }}')
                                    $wire.setAnswer({{ $questionKey }}, answers)
                                "
                                                id="option_{{ $questionKey }}" type="radio"
                                                name="option_{{ $questionKey }}"
                                                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 disabled:opacity-50"
                                                wire:model="answers.{{ $questionKey }}.option_id.0"
                                                value="{{ $option->id }}">{{ $option->label }}</label>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <span class="inline-block text-sm text-orange-600">No Options are available</span>
                        @endif
                    @else
                        @if ($question->options()->count())
                            @error("answers.$questionKey.answer")
                                <x-input-error :messages="$message" />
                            @enderror

                            <div x-data='{
                                        answers: [],
                                        setAnswer(isChecked, answer) {
                                            if(isChecked) {
                                                this.answers.push(answer)
                                            } else {
                                                this.answers = this.answers.filter(item => item !== answer)
                                            }
                                        }
                                    }'
                                class="grid gap-2 *:border-b *:pb-2 *:inline-block *:w-2/5 *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7">

                                @foreach ($question->options as $optionKey => $option)
                                    <div wire:key="{{ $optionKey }}">
                                        <label>
                                            <input wire:loading.attr="disabled" wire:target="setAnswer"
                                                x-on:change="
                                setAnswer($event.target.checked, '{{ $option->label }}')
                                $wire.setAnswer({{ $questionKey }}, answers)
                            "
                                                id="option_{{ $questionKey }}" type="checkbox"
                                                name="option_{{ $questionKey }}"
                                                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 disabled:opacity-50"
                                                wire:model="answers.{{ $questionKey }}.option_id"
                                                value="{{ $option->id }}">
                                            {{ $option->label }}
                                        </label>
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
                </div>
            @endforeach
            <button type="submit"
                class="relative px-5 py-1 text-white bg-indigo-600 rounded-md text-md hover:bg-indigo-500 focus:ring-2 ring-indigo-600 ring-offset-2 disabled:opacity-50">
                Submit <span wire:loading.inline-flex wire:target="save"
                    class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center animate-spin">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#915f5f">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12 3C10.22 3 8.47991 3.52784 6.99987 4.51677C5.51983 5.50571 4.36628 6.91131 3.68509 8.55585C3.0039 10.2004 2.82567 12.01 3.17294 13.7558C3.5202 15.5016 4.37737 17.1053 5.63604 18.364C6.89472 19.6226 8.49836 20.4798 10.2442 20.8271C11.99 21.1743 13.7996 20.9961 15.4442 20.3149C17.0887 19.6337 18.4943 18.4802 19.4832 17.0001C20.4722 15.5201 21 13.78 21 12"
                                stroke="#000000" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M19.7942 7.5C19.8905 7.66673 19.9813 7.83651 20.0667 8.00907" stroke="#000000"
                                stroke-width="2" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </span>
            </button>
        </form>
    @else
        <x-no-content>
            This quiz has no questions
        </x-no-content>
    @endif
</div>

@assets
    <style>
        label,
        [type="radio"],
        [type="checkbox"] {
            cursor: pointer;
        }
    </style>
@endassets
