<div
    class="p-3 flex text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2/3 bg-white border-none min-h-40 *:bg-gray-100">
    <div class="flex flex-col items-center justify-center flex-1 p-4 font-bold text-gray-500 text-lg">
        {{ $slot->isEmpty() ? 'No Content' : $slot }}

        <a href="{{ url()->previous() }}" class="text-blue-600 p-2 text-base font-extrabold">&LeftArrow; Back to
            Previous
            Page</a>
    </div>

</div>
