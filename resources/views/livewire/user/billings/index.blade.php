<div class="max-w-3xl p-5 m-auto space-y-3">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()?->tenant_id)
        <div class="py-4 space-y-12">
            <form wire:submit="saveChanges"
                class="p-8 bg-white border border-t-4 border-b-4 rounded-lg shadow-lg border-b-indigo-600 border-t-indigo-600">

                @if ($errors->any())
                    <div class="py-2">
                        <x-input-error :messages="$errors->all()" />
                    </div>
                @endif

                <div class="space-y-12">
                    <div class="pb-12 border-b border-gray-900/10">
                        <h2 class="text-2xl font-semibold leading-7 text-gray-700">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive
                            mail.
                        </p>

                        <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name"
                                    class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <input wire:model.blur="form.name" type="text" name="name" id="name"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('form.name')
                                        !border-2 !border-red-600
                                    @enderror">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input wire:model.blur="form.email" id="email" name="email" type="email"
                                        autocomplete="email"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('form.email')
                                    !border-2 !border-red-600
                                @enderror">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="city"
                                    class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                <div class="mt-2">
                                    <input wire:model.blur="form.city" type="text" name="city" id="city"
                                        autocomplete="address-level2"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('form.city')
                                    !border-2 !border-red-600
                                @enderror">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State /
                                    Province</label>
                                <div class="mt-2">
                                    <input wire:model.blur="form.region" type="text" name="region" id="region"
                                        autocomplete="address-level1"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('form.region')
                                    !border-2 !border-red-600
                                @enderror">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="country"
                                    class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                <div class="mt-2">
                                    <select wire:model.blur="form.country" id="country" name="country"
                                        autocomplete="country-name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('form.country')
                                    !border-2 !border-red-600
                                @enderror">
                                        <option value="BD" selected disabled>Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end mt-6 gap-x-6">
                    <button wire:loading.attr="disabled" wire:target="saveChanges" type="submit"
                        class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:bg-gray-600 disabled:opacity-50">Save
                        Changes</button>
                </div>
            </form>
        </div>
    @endif

    <div class="space-y-2 sm:flex sm:flex-wrap sm:justify-between">
        <div class="flex-1 shrink">
            <h1 class="text-xl font-bold text-stone-700">Current Plan</h1>
        </div>
        <div
            class="flex flex-wrap items-center justify-between flex-1 sm:min-w-[450px] gap-4 p-5 bg-white border rounded-md shadow-sm">
            <div>
                <span class="text-lg font-bold text-slate-600">Fresher</span>
                <ul class="grid gap-1 mt-2 text-sm text-gray-600">
                    <li>5 quizzes</li>
                </ul>
            </div>
            <div class="flex gap-4 p-4 border border-indigo-600 rounded-lg">
                <span class="inline-flex items-start gap-1 text-xs font-bold text-gray-600">
                    BDT <span class="h-full text-3xl font-extrabold text-slate-800">500</span>
                </span>
                <a href="{{ route('user.billings.plan') }}"
                    class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg hover:bg-indigo-700">Upgrade Plan</a>
            </div>
        </div>
    </div>
</div>

</div>
