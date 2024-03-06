<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="px-8 pb-2 text-2xl text-extrabold text-gray-600">Overview</h1>
            <div class="flex flex-wrap gap-4 items-center justify-center p-8">
                <div
                    class="flex-1 relative p-6 rounded-2xl bg-white dark:bg-gray-800 ring-2 ring-slate-300 ring-offset-2 shadow-md">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-xl font-medium text-slate-500">

                            <span>Total Quizzes</span>
                        </div>

                        <div class="text-2xl text-indigo-600 font-extrabold">
                            {{ auth()->user()->quizzes()->count() }}
                        </div>
                    </div>
                </div>

                <div
                    class="flex-1 relative p-6 rounded-2xl bg-white dark:bg-gray-800 ring-2 ring-slate-300 ring-offset-2 shadow-md">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-xl font-medium text-slate-500">

                            <span>Total Participations</span>
                        </div>

                        <div class="text-2xl text-indigo-600 font-extrabold">
                            {{ auth()->user()->getTotalQuizResponses() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
