<div class="max-w-3xl p-5 m-auto space-y-3">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Upgrade Plans') }}
        </h2>
    </x-slot>

    <!-- ====== Pricing Section Start -->
    @if ($products->count())
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div class="mx-auto mb-[60px] max-w-[510px] text-center">
                        <span class="block mb-2 text-lg font-semibold text-primary">
                            Pricing Table
                        </span>
                        <h2
                            class="mb-3 text-3xl leading-[1.208] font-bold text-dark dark:text-white sm:text-4xl md:text-[40px]">
                            Our Pricing Plan
                        </h2>
                        <p class="text-base text-body-color dark:text-dark-6">
                            Currently we support following few plans. Take a choise into enterprise plan to get
                            unlimited
                            access of quizzes.
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-row-reverse flex-wrap justify-center gap-5">
                @foreach ($products as $product)
                    <div class="flex-1 max-w-lg min-w-[320px]">
                        <div
                            class="relative z-10 mb-10 overflow-hidden rounded-[10px] border-2  border-t-4 border-t-indigo-600 dark:border-dark-3 bg-white dark:bg-dark-2 p-5">
                            <span class="block mb-3 text-lg font-semibold text-indigo-500">
                                {{ $product->name }}
                            </span>
                            <h2 class="mb-5 text-xl font-extrabold text-slate-700 dark:text-white">
                                <span>{{ $product->price_formatted }}</span>
                            </h2>
                            <div
                                class="pb-8 mb-8 text-gray-600 border-b text-md border-stroke dark:border-dark-3 dark:text-dark-6">
                                {!! $product->description !!}
                            </div>
                            <div class="flex flex-col gap-5 mb-9">
                                @foreach (call_user_func(["App\\Constants\\Product\\$product->name", 'getFacilities']) as $facility)
                                    <p class="inline-flex gap-2 text-sm font-bold text-stone-700 dark:text-dark-6">
                                        <svg class="flex-shrink-0 w-4 h-4 text-lime-700 dark:text-lime-500"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        {{ $facility }}
                                    </p>
                                @endforeach
                            </div>

                            @if ($product->isFresher())
                                <button disabled
                                    class="block w-full p-3 text-base font-bold text-center text-white duration-100 bg-indigo-600 rounded-lg hover:bg-indigo-800 disabled:bg-gray-400">
                                    Free
                                </button>
                            @else
                                <a href="{{ $product->buy_now_url }}" target="_blank"
                                    class="block w-full p-3 text-base font-bold text-center text-white duration-100 bg-indigo-600 rounded-lg hover:bg-indigo-800">
                                    Buy Now
                                </a>
                            @endif
                            <div>
                                <span class="absolute right-0 top-7 z-[-1]">
                                    <svg width="77" height="172" viewBox="0 0 77 172" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="86" cy="86" r="86" fill="url(#paint0_linear)" />
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="86" y1="0"
                                                x2="86" y2="172" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#3056D3" stop-opacity="0.09" />
                                                <stop offset="1" stop-color="#C4C4C4" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                                <span class="absolute right-4 top-4 z-[-1]">
                                    <svg width="41" height="89" viewBox="0 0 41 89" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="38.9138" cy="87.4849" r="1.42021"
                                            transform="rotate(180 38.9138 87.4849)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="74.9871" r="1.42021"
                                            transform="rotate(180 38.9138 74.9871)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="62.4892" r="1.42021"
                                            transform="rotate(180 38.9138 62.4892)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="38.3457" r="1.42021"
                                            transform="rotate(180 38.9138 38.3457)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="13.634" r="1.42021"
                                            transform="rotate(180 38.9138 13.634)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="50.2754" r="1.42021"
                                            transform="rotate(180 38.9138 50.2754)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="26.1319" r="1.42021"
                                            transform="rotate(180 38.9138 26.1319)" fill="#3056D3" />
                                        <circle cx="38.9138" cy="1.42021" r="1.42021"
                                            transform="rotate(180 38.9138 1.42021)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="87.4849" r="1.42021"
                                            transform="rotate(180 26.4157 87.4849)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="74.9871" r="1.42021"
                                            transform="rotate(180 26.4157 74.9871)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="62.4892" r="1.42021"
                                            transform="rotate(180 26.4157 62.4892)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="38.3457" r="1.42021"
                                            transform="rotate(180 26.4157 38.3457)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="13.634" r="1.42021"
                                            transform="rotate(180 26.4157 13.634)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="50.2754" r="1.42021"
                                            transform="rotate(180 26.4157 50.2754)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="26.1319" r="1.42021"
                                            transform="rotate(180 26.4157 26.1319)" fill="#3056D3" />
                                        <circle cx="26.4157" cy="1.4202" r="1.42021"
                                            transform="rotate(180 26.4157 1.4202)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="87.4849" r="1.42021"
                                            transform="rotate(180 13.9177 87.4849)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="74.9871" r="1.42021"
                                            transform="rotate(180 13.9177 74.9871)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="62.4892" r="1.42021"
                                            transform="rotate(180 13.9177 62.4892)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="38.3457" r="1.42021"
                                            transform="rotate(180 13.9177 38.3457)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="13.634" r="1.42021"
                                            transform="rotate(180 13.9177 13.634)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="50.2754" r="1.42021"
                                            transform="rotate(180 13.9177 50.2754)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="26.1319" r="1.42021"
                                            transform="rotate(180 13.9177 26.1319)" fill="#3056D3" />
                                        <circle cx="13.9177" cy="1.42019" r="1.42021"
                                            transform="rotate(180 13.9177 1.42019)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="87.4849" r="1.42021"
                                            transform="rotate(180 1.41963 87.4849)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="74.9871" r="1.42021"
                                            transform="rotate(180 1.41963 74.9871)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="62.4892" r="1.42021"
                                            transform="rotate(180 1.41963 62.4892)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="38.3457" r="1.42021"
                                            transform="rotate(180 1.41963 38.3457)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="13.634" r="1.42021"
                                            transform="rotate(180 1.41963 13.634)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="50.2754" r="1.42021"
                                            transform="rotate(180 1.41963 50.2754)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="26.1319" r="1.42021"
                                            transform="rotate(180 1.41963 26.1319)" fill="#3056D3" />
                                        <circle cx="1.41963" cy="1.4202" r="1.42021"
                                            transform="rotate(180 1.41963 1.4202)" fill="#3056D3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- ====== Pricing Section End -->
</div>
