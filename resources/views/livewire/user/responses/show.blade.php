<form wire:submit="save">
    <div class="py-12">
        {{-- ====================Quiz Informations======================= --}}
        {{-- ====================*****************======================= --}}
        {{-- ====================*****************======================= --}}
        <div
            class="flex flex-col p-4 space-y-3 bg-white border border-t-8 rounded-md shadow sm:p-8 border-slate-300 dark:bg-gray-800 sm:rounded-lg border-t-indigo-600">

            <div class="text-lg font-bold text-right text-indigo-500">
                Marks: <span class="px-2 py-1 text-sm text-white bg-indigo-500 rounded-full">35</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-center sm:text-3xl text-stone-500">A Model Question Quiz
                for That
            </h1>

            <p class="tracking-tight text-center text-gray-500 text-md">Quiz Description Lovoluptates dolore
                dignissimosp!</p>
        </div>
    </div>

    {{-- ======================Questions=========================== --}}
    {{-- ====================*************======================= --}}
    {{-- ====================*************======================= --}}
    <div class="space-y-4">


        <div
            class="relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3">
            <div class="text-right">
                <span class="px-2 py-1 ml-auto text-sm text-white bg-indigo-500 rounded-full">5</span>
            </div>

            <div class="flex justify-between gap-5">
                <div class="flex-1 text-lg font-bold tracking-tight sm:text-xl text-stone-600">
                    What is the capital city of Bangladesh??
                </div>
            </div>

            {{--
            <x-question.text-input name="some_name" :error="$errors?->first('some_name')" placeholder="Your answer!" />
            @error('some_name')
            <x-input-error :messages="$message" />
            @enderror --}}
            {{--
            <x-question.textarea name="some_name" :error="$errors?->first('some_name')" placeholder="Your answer!" />
            @error('some_name')
            <x-input-error :messages="$message" />
            @enderror --}}


            {{-- <div
                class="grid gap-2 *:border-b *:pb-2 *:inline-block *:w-2/5 *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7">
                <label>
                    <input id="option" type="radio" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 1
                </label>
                <label>
                    <input id="option" type="radio" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 3
                </label>
                <label>
                    <input id="option" type="radio" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 2
                </label>
                <label>
                    <input id="option" type="radio" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 4
                </label>
            </div> --}}


            <div
                class="grid gap-2 *:border-b *:pb-2 *:inline-block *:w-2/5 *:max-w-xs *:text-gray-700 *:text-[15px] *:h-7">
                <label>
                    <input id="option" type="checkbox" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 1
                </label>
                <label>
                    <input id="option" type="checkbox" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 3
                </label>
                <label>
                    <input id="option" type="checkbox" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 5
                </label>
                <label>
                    <input id="option" type="checkbox" name="option"
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    Option 2
                </label>
            </div>

            <div class="p-2 text-sm text-yellow-800 bg-yellow-100 border-l-2 border-l-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
                role="alert">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum ad officia fugiat impedit possimus
                unde nostrum, eum tenetur sapiente quo.
            </div>
        </div>

        <div
            class="relative p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3">
            <div class="text-right">
                <span class="px-2 py-1 ml-auto text-sm text-white bg-indigo-500 rounded-full">5</span>
            </div>

            <div class="flex justify-between gap-5">
                <div class="flex-1 text-lg font-bold tracking-tight sm:text-xl text-stone-600">
                    What is the capital city of Bangladesh??
                </div>
            </div>

            <x-question.textarea name="some_name" :error="$errors?->first('some_name')" placeholder="Your answer!" />
            @error('some_name')
            <x-input-error :messages="$message" />
            @enderror

            <div class="p-2 text-sm text-yellow-800 bg-yellow-100 border-l-2 border-l-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
                role="alert">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum ad officia fugiat impedit possimus
                unde nostrum, eum tenetur sapiente quo.
            </div>
        </div>


    </div>
</form>
