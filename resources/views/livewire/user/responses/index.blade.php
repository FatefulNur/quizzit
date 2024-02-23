<div class="max-w-xl p-5 m-auto space-y-3">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Participations') }}
        </h2>
    </x-slot>

    @forelse ($responses as $response)

    <a class="flex flex-col flex-wrap gap-4 p-4 transition transform bg-white rounded-sm shadow hover:shadow-lg" href="#">

        <!-- Icon -->
        <div class="flex justify-between">
            <span
            class="px-3 py-1 text-xs font-extrabold text-indigo-800 bg-indigo-100 rounded-full shadow-sm w-fit me-2 dark:bg-indigo-900 dark:text-indigo-300">Result: {{ $response->result }}</span>

            <div class="text-sm font-bold text-stone-600">
                by: <span class="text-xs font-extrabold text-green-700">{{ $response->user->name }}</span>
            </div>
        </div>

        <div>
            <!-- Title -->
            <div class="flex-1">
              <p class="font-semibold text-blue-600">{{ $response->quiz->title }}</p>
            </div>

            <!-- Description -->
            <div class="flex-1">
              <p class="text-sm font-light text-gray-800">{{ $response->quiz->description }}</p>
            </div>
        </div>

    </a>

    @empty
    <x-no-content />
    @endforelse

    @if ($responses->isNotEmpty())
        <div class="bg-white p-5 max-w-4xl !mt-6 m-auto border-t border-t-gray-300">
            {{ $responses->links(data: ['scrollTo' => false]) }}
        </div>
    @endif
</div>
