<div
    class="shadow-md rounded-sm p-3 flex text-center mx-auto max-w-lg w-full bg-white border-none min-h-40 *:bg-gray-100">
    <div class="flex flex-col items-center justify-center flex-1 gap-3 p-4 text-lg font-bold text-gray-500">
        {{ $slot->isEmpty() ? 'No Content' : $slot }}

        <div class="space-x-2">
            <a href="{{ url()->previous() }}" class="p-2 text-base font-extrabold text-blue-600">&LeftArrow; Get
                Back</a>
            |
            <a href="{{ route('user.dashboard') }}" class="p-2 text-base font-extrabold text-blue-600">Visit
                Dashboard</a>
        </div>
    </div>
</div>
