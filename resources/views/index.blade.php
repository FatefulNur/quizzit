<x-frontend-layout>
    <section class="container mx-auto space-y-4 dark:bg-gray-900">

        @include('partials.navbar')

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
                <a target="_blank" href="{{ route('user.quizzes.show', $quiz->id) }}" @class([
                    'relative flex flex-col justify-between p-4 leading-normal bg-white border border-gray-400 rounded',
                    '!bg-gray-200 opacity-60' => $quiz->hasExpired(),
                ])>
                    <div class="absolute text-sm font-bold top-2 right-2 text-emerald-700 dark:text-white">
                        Marks: {{ $quiz->marks_total }}
                    </div>
                    <div class="mb-8">
                        @if ($quiz->isPrivate())
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ $quiz->type }}</span>
                        @else
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $quiz->type }}</span>
                        @endif

                        <div class="mb-2 text-xl font-bold text-gray-900">{{ $quiz->title }}</div>
                        <p class="text-sm leading-tight text-gray-600 line-clamp-2">Lorem,
                            {{ $quiz->description }}
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2 text-sm">
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
                </a>

            @empty
                <x-no-content />
            @endforelse

        </div>
        @if ($quizzes->isNotEmpty())
            <div class="bg-white p-5 max-w-4xl !mt-6 m-auto border-t border-t-gray-300">
                {{ $quizzes->links() }}
            </div>
        @endif

        @if ($products->count())
            {{-- Available Products Card --}}
            <div id="pricing"
                class="mx-auto !mt-36 py-36 pt-12 flex flex-row-reverse flex-wrap md:flex-nowrap justify-center gap-8 px-4 sm:px-8 md:px-32 *:shadow-lg *:min-w-[320px] bg-gradient-to-t from-slate-100 to-slate-300 from-30% md:*:-mt-28">

                @foreach ($products as $product)
                    <div
                        class="relative flex items-center justify-between flex-1 max-w-md p-4 bg-white rounded-lg shadow-xl shadow-indigo-400">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Total Ballance</h2>
                            <h3 class="mt-2 text-xl font-bold text-left text-indigo-500">
                                {{ $product->price_formatted }}
                            </h3>
                            <ul class="mt-4 space-y-3">
                                @foreach (call_user_func(["App\\Constants\\Product\\$product->name", 'getFacilities']) as $facility)
                                    <li class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 text-indigo-700 dark:text-indigo-500"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        <span
                                            class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3">{{ $facility }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            @if ($product->isFresher())
                                <a href="{{ route('login') }}"
                                    class="inline-block px-4 py-2 mt-6 text-sm tracking-wider text-white bg-indigo-400 rounded-lg outline-none hover:bg-indigo-500">Try
                                    it Out</a>
                            @else
                                <a href="{{ route('user.billings.plan') }}"
                                    class="inline-block px-4 py-2 mt-6 text-sm tracking-wider text-white bg-red-400 rounded-lg outline-none hover:bg-red-500">Try
                                    it Out</a>
                            @endif
                        </div>
                        <div @class([
                            'absolute flex items-center justify-center w-32 h-32 border-2 border-white border-dashed rounded-full shadow-2xl -top-2 -right-2 bg-gradient-to-tr from-indigo-500 to-indigo-500 shadow-indigo-400',
                            'from-red-500 to-red-500 shadow-red-400' => !$product->isFresher(),
                        ])>
                            <div>
                                <h1 class="text-2xl text-white">{{ $product->name }}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-frontend-layout>
