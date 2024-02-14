@props(['name' => '', 'error'])

<div class="relative text-stone-600" >
    <input type="text" name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full px-0 text-md border-0 h-14 bg-gray-50 focus:shadow-none outline-0 peer']) }}
        style="box-shadow: none" autocomplete="off">
    <div
        class="absolute h-[2px] bottom-0 left-1/2 right-1/2 bg-indigo-700 peer-focus:left-0 peer-focus:right-0 peer-focus:transition-all z-20">
    </div>
    <div class="absolute h-[2px] bottom-0 left-0 right-0 bg-gray-200 w-full {{ $error ? 'bg-red-500' : '' }} z-10"></div>
</div>
