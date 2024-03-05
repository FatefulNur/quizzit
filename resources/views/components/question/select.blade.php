@props(['items', 'error', 'disabled' => false])

<div class="relative text-stone-600">
    <select name="type" id="type" {{ $attributes->merge(['class'=>"w-full border-0 h-14 bg-gray-50
        peer"]) }} style="box-shadow: none"
        title="Question type" x-on:change="questionType = $event.target.value">

        <option selected @disabled($disabled)>Select a Question Type</option>
        @foreach ($items as $item)

        <option value="{{ $item?->value }}">{{ $item?->getLabel() }}</option>

        @endforeach

    </select>
    <div
        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
    </div>
    <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full {{ $error ? 'bg-red-500' : '' }} z-10">
    </div>
</div>
