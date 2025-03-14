<div>
    <div class="mb-6">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="mb-3">
                <label for="id_product"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                <select wire:model.live.change='id_product' id="id_product"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                <input wire:model='quantity' id="quantity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="number" value="1">
            </div>
            <div class="mb-3">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                <input wire:model='price' wire:key='{{ $id_product }}' id="price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="number" value="0">
            </div>
        </div>
        <button wire:click='addItem' type="button"
            class="mb-6 text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Green</button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Product</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($selected_items as $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 event:bg-gray-50 event:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-3">{{ $item->product_name }}</td>
                        <td class="px-6 py-3">{{ $item->quantity }}</td>
                        <td class="px-6 py-3">{{ $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-filament-actions::modals />
    <script>
        $(document).ready(function() {

        });

        $("select[name='id_product']").on('change', function() {
            Livewire.dispatch('updateSelectedProduct', $(this).val())
        })
    </script>
</div>
