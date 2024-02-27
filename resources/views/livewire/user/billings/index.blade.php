<div class="max-w-3xl p-5 m-auto space-y-3">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-2 sm:flex sm:flex-wrap sm:justify-between">
        <div class="flex-1 shrink">
            <h1 class="text-xl font-bold text-stone-700">Current Plan</h1>
        </div>
        <div
            class="flex flex-wrap items-center justify-between flex-1 sm:min-w-[450px] gap-4 p-5 bg-white border rounded-md shadow-sm">
            <div>
                <span class="text-lg font-bold text-slate-600">Fresher</span>
                <ul class="grid gap-1 mt-2 text-sm text-gray-600">
                    <li>5 quizzes</li>
                </ul>
            </div>
            <div class="flex gap-4 p-4 border border-indigo-600 rounded-lg">
                <span class="inline-flex items-start gap-1 text-xs font-bold text-gray-600">
                    BDT <span class="h-full text-3xl font-extrabold text-slate-800">500</span>
                </span>
                <button class="px-3 py-1 text-white bg-indigo-500 rounded-lg text-md">Upgrade Plan</button>
            </div>
        </div>
    </div>
</div>
