<div
    class="p-3 flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-2/3 bg-white border-none min-h-40 *:bg-gray-100">
    <div class=" flex-1 p-4 flex items-center justify-center">
        {{ $slot->isEmpty() ? 'No Content' : $slot }}
    </div>
</div>