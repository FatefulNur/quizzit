@props(['name' => '', 'error'])

<div class="relative text-stone-600" x-data>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="10" {{ $attributes->merge(['class' => 'w-full px-0 border-0 resize-none h-12 max-h-32 bg-gray-50 text-md focus:shadow-none outline-0 peer']) }}
        style="box-shadow: none"
        x-on:input="
                                                $el.style.height = '48px'
                                                $el.style.height = $event.target.scrollHeight + 'px'
                                            "></textarea>
    <div
        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
    </div>
    <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full {{ $error ? 'bg-red-500' : '' }} z-10">
    </div>
</div>
