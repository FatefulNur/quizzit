<x-repeater>
    <div class="relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3"
        x-data='{questionType: ""}'>
        <div class="relative inline-block w-[70px]">
            <input min="1" type="number" name="marks" id="marks" placeholder="Marks"
                class="text-center px-0 w-full h-12 text-md bg-gray-50 focus:shadow-none border-0 outline-0 peer"
                style="box-shadow: none" autocomplete="off">
            <div
                class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
            </div>
            <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>
        </div>

        <div class="flex space-x-28">
            <div class="relative flex-1 text-stone-600">
                <input type="text" name="question_title" id="question_title" placeholder="Ask a question?"
                    class="px-0 w-full h-14 text-2xl bg-gray-50 focus:shadow-none border-0 outline-0 peer"
                    style="box-shadow: none" autocomplete="off">
                <div
                    class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                </div>
                <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>
            </div>

            <div class="relative block text-stone-600">
                <select name="question_type" id="question_type" class="h-14 border-0 w-full bg-gray-50 peer"
                    style="box-shadow: none" title="Question type" x-on:change="questionType = $event.target.value">
                    <option disabled selected>Select a Question Type</option>
                    @foreach (App\Enums\QuestionType::cases() as $type)
                        <option value="{{ $type->value }}">{{ $type->getLabel() }}</option>
                    @endforeach
                </select>

                <div
                    class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                </div>
                <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>
            </div>
        </div>

        <div class="relative mb-3 text-stone-600">
            <textarea name="hint" id="hint" rows="10" placeholder="Say more about this quiz!"
                x-bind:class="`px-0 w-full h-12 max-h-32 resize-none bg-gray-50 text-md focus:shadow-none border-0 outline-0 peer`"
                style="box-shadow: none"
                x-on:input="
                                $el.style.height = '32px'
                                $el.style.height = $event.target.scrollHeight + 'px'
                            "></textarea>
            <div
                class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all">
            </div>
        </div>

        <template x-if="questionType === 'short_text'">
            <x-question.options.short-text />
        </template>

        <template x-if="questionType === 'long_text'">
            <x-question.options.long-text />
        </template>

        <template x-if="questionType === 'radio'">
            <x-question.options.radio />
        </template>

        <template x-if="questionType === 'checkbox'">
            <x-question.options.checkbox />
        </template>
    </div>
</x-repeater>
