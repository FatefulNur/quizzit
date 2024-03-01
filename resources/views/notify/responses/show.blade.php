<x-frontend-layout>
    <x-notify heading="Thanks!">
        Your feedback has added. Check you result...
        <x-slot:button :href="route('user.responses.show', $response)">
            Check Now
        </x-slot:button>
    </x-notify>
</x-frontend-layout>
