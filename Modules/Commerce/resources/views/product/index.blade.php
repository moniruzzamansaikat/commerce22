<x-commerce::layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between">
                <div x-data="{
                    perPage: new URLSearchParams(window.location.search).get('per_page') || '10'
                }" 
                x-init="
                    $watch('perPage', value => {
                        const url = new URL(window.location.href);
                        url.searchParams.set('per_page', value);
                        window.location.href = url.toString();
                    })
                ">
                    <select x-model="perPage">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>

                <x-primary-button href="{{ route('commerce.product.create') }}" >@lang('Add New')</x-primary-button>
            </div>
                    

            <table
                class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Name') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Category') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Price') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Cost') }}</th>
                        <th class="py-2 px-4 text-right text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ $product->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ @$product->category->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ showAmount($product->price) }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ showAmount($product->cost) }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300 text-right">
                                <x-table.edit-button :href="route('commerce.product.edit', $product->slug)" />
                                |
                                <x-delete-cell-button route="{{ route('commerce.product.destroy', $product->id) }}"  />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                @if ($products->hasPages())
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>
</x-commerce::layouts.master>