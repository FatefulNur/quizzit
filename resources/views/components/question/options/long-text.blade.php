<div class="p-3 flex-1 text-stone-600 space-y-4">
    <div class="border-b border-slate-500 w-1/2">
        <label
            class="inline-block px-0 w-full h-8 text-sm bg-gray-50 text-gray-800 focus:shadow-none border-0 outline-0">Long
            Text</label>
    </div>

    <label class="inline-block text-indigo-500 text-md font-semibold cursor-pointer peer">
        Set an Answer
        <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
    </label>

    <ul class="hidden peer-has-[:checked]:block">
        <li class="relative">
            <textarea name="answer_text" id="answer_text" rows="10" placeholder="e.g. answer1, answer2"
                x-bind:class="`px-0 w-full h-12 max-h-32 resize-none bg-gray-50 text-md focus:shadow-none border-0 outline-0 peer`"
                style="box-shadow: none"
                x-on:input="
                        $el.style.height = '32px'
                        $el.style.height = $event.target.scrollHeight + 'px'
                    "></textarea>
            <div
                class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
            </div>
            <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>
        </li>
    </ul>
</div>
