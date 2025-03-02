<div>
    <form>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="mb-3">
                <label for="product"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                <select wire:model='id_product' id="product"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
        </div>
        <input wire:model='price' type="text">
        <button wire:click='addItems' type="submit">Simpan Penjualan</button>
    </form>

    <x-filament-actions::modals />

</div>