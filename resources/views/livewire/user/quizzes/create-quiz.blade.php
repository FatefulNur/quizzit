<form action="#">
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create new Quiz') }}
            </h2>

            <div class="flex justify-between">
                <div class="flex">
                    <label for="quiz_type"
                        class="mr-1 ms-3 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Private?</label>
                    <label class="relative inline-flex items-center mb-5 cursor-pointer">
                        <input id="quiz_type" type="checkbox" class="sr-only peer">
                        <div
                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 space-y-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- schedule expiration --}}
            <div class="flex-1 text-right">
                <div class="p-2 inline-flex gap-2 justify-end items-center shadow-md bg-white rounded-md">
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

                    <label class="cursor-pointer text-sm font-semibold text-gray-500">
                        Expiration Date
                        <input class="w-0 p-0 border-none" type="text" name="expired_at" data-picker
                            style="box-shadow: none">
                    </label>
                </div>
            </div>

            {{-- ====================Quiz Title Setup======================= --}}
            <div
                class="flex flex-col p-4 sm:p-8 bg-white border border-slate-300 border-l-4 dark:bg-gray-800 shadow sm:rounded-lg rounded-md has-[:focus]:border-l-indigo-600 space-y-3">

                <div class="relative block text-stone-600">
                    <input type="text" name="quiz_title" id="quiz_title" placeholder="Quiz Heading"
                        class="px-0 w-full h-14 text-2xl bg-gray-50 focus:shadow-none border-0 outline-0 peer"
                        style="box-shadow: none" autocomplete="off">
                    <div
                        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
                    </div>
                    <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full z-10"></div>
                </div>

                <div class="relative mb-3 text-stone-600" x-data="">
                    <textarea name="description" id="description" rows="10" placeholder="Say more about this quiz!"
                        x-bind:class="`px-0 w-full h-14 max-h-32 resize-none bg-gray-50 text-md focus:shadow-none border-0 outline-0 peer`"
                        style="box-shadow: none"
                        x-on:input="
                                            $el.style.height = '48px'
                                            $el.style.height = $event.target.scrollHeight + 'px'
                                        "></textarea>
                    <div
                        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all">
                    </div>
                </div>
            </div>

            {{-- ======================================= --}}

        </div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <livewire:question>
        </div>
    </div>
</form>

@assets
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endassets

@script
    <script>
        new Pikaday({
            field: document.querySelector('[data-picker]'),
            position: 'bottom',
            minDate: new Date(),
        });
    </script>
@endscript
