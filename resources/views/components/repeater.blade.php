@props(['addButton' => 'normal', 'width' => 'w-full'])

<div class="space-y-4"
    x-data='
        {
            id: 1,
            items: [{id: 1, element: $el}],

            addElement() {
                let data = [
                    ...this.items,
                    {
                        id: ++this.id,
                        element: $el
                    }
                ]
                this.items = data
            },

            removeElement(id) {
                if(this.items.length > 1) {
                    let data = this.items.filter((item) => item.id !== id)
                    this.items = data
                }
            }
        }
    '>
    <template x-for="(item, index) in items" :key="item.id">
        <div @class(['relative', 'group', $width])>
            <button x-show="items.length > 1" x-on:click="removeElement(item.id)" type="button"
                class="inline-block invisible absolute -top-1 -right-1 w-7 h-7 leading-6 text-2xl font-bold text-red-600 shadow-md border transition rounded-full bg-white group-hover:visible z-50">&times;</button>
            {{ $slot }}
        </div>
    </template>

    @if ($addButton == 'radio')
        <div class="flex items-center me-4 h-6" x-on:click="addElement()">
            <label
                class="inline-block px-0 {{ $width }} h-8 leading-8 text-sm bg-gray-50 text-gray-800 focus:shadow-none border-0 outline-0 border-b-2 cursor-pointer">
                <span
                    class="mr-1 inline-block w-4 h-4 rounded-full bg-gray-100 align-middle border border-gray-300"></span>
                Add More Option</label>
            </span>
        </div>
    @elseif ($addButton == 'checkbox')
        <div class="flex items-center me-4 h-6" x-on:click="addElement()">
            <label
                class="inline-block px-0 {{ $width }} h-8 leading-8 text-sm bg-gray-50 text-gray-800 focus:shadow-none border-0 outline-0 border-b-2 cursor-pointer">
                <span class="mr-1 inline-block w-4 h-4 rounded bg-gray-100 align-middle border border-gray-300"></span>
                Add More Option</label>
            </span>
        </div>
    @else
        <button type="button" title="Add More Questions" x-on:click="addElement()"
            class="ml-auto block px-1 w-8 h-8 leading-8 text-3xl font-bold text-white bg-indigo-800 rounded-full
        hover:bg-indigo-600 transition">&plus;</button>
    @endif
</div>
