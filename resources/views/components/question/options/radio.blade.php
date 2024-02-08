<div class="p-3 flex-1 text-stone-600 space-y-4">
    <label class="inline-block text-indigo-500 text-md font-semibold cursor-pointer peer">
        Set Options
        <input type="checkbox" name="answer_checkbox" id="answer_checkbox" class="hidden">
    </label>

    <ul class="hidden peer-has-[:checked]:block">
        <p class="mb-1 text-sm text-gray-400 font-bold">Set correct answer by checking an option.</p>
        <x-repeater add-button="radio" width="w-2/5">
            <li class="relative w-full">
                <div class="relative flex gap-2 items-center me-4 h-8 bg-gray-50">
                    <input id="option" type="radio" name="option[]"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                    <input type="text" name="label" id="label" placeholder="Set a label?"
                        class="px-0 w-full h-8 text-md bg-gray-50 focus:shadow-none border-0 outline-0 peer"
                        style="box-shadow: none" autocomplete="off">
                    <div
                        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                    </div>
                    <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>

                </div>
            </li>
        </x-repeater>
    </ul>
</div>
