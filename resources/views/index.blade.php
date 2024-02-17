<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100">
    <section class="dark:bg-gray-900 w-full space-y-4">
        <div class="flex flex-col items-center justify-center p-12 border-b border-b-gray-200"
            style="background: url({{ asset('images/Cloudy.svg') }})">
            <h1
                class="mb-2 text-xl font-extrabold leading-none tracking-tight text-slate-700 md:text-3xl lg:text-4xl dark:text-white">
                {{ str(config('app.name'))->title() }}</h1>
            <p class="mb-5 text-lg font-extrabold text-gray-500 lg:text-xl dark:text-gray-200">
                An Open Quiz Platform! Get to know thyself
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                <a href="{{ route('user.quizzes.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Own Your Quizzes
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="p-4 max-w-4xl grid m-auto gap-3 grid-cols-[repeat(auto-fit,_minmax(250px,_1fr))]">

            @forelse ($quizzes as $quiz)

            <div @class(["flex flex-col justify-between p-4 leading-normal bg-white border border-gray-400
                rounded", "bg-amber-100 opacity-80"=> $quiz->hasExpired()])>

                <div class="mb-8">
                    @if ($quiz->isPublic())
                    <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{
                        $quiz->type }}</span>
                    @else
                    <span
                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{
                        $quiz->type }}</span>
                    @endif

                    <div class="mb-2 text-xl font-bold text-gray-900">{{ $quiz->title }}</div>
                    <p class="text-sm text-gray-600 line-clamp-2 leading-tight">Lorem,
                        {{ $quiz->description }}
                    </p>
                </div>
                <div class="flex flex-wrap justify-between gap-2 items-center text-sm">
                    <p class="text-lg font-extrabold text-stone-500">{{ $quiz->user->name }}</p>
                    <div class="flex gap-1">
                        <p
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>
                            {{ $quiz->created_at->diffForHumans() }}
                        </p>
                        <p
                            class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                            {{ $quiz->getDaysLeft() }} Days Left
                        </p>
                    </div>
                </div>
            </div>

            @empty
            <x-no-content />
            @endforelse

        </div>
        @if ($quizzes->isNotEmpty())
        <div class="bg-white p-5 max-w-4xl !mt-6 m-auto border-t border-t-gray-300">
            {{ $quizzes->links() }}
        </div>
        @endif
    </section>
</body>

</html>
