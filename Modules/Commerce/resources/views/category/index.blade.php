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

                <x-primary-button href="{{ route('commerce.category.create') }}" >@lang('Add New')</x-primary-button>
            </div>
                    

            <table
                class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Name') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Slug') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Status') }}</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Image') }}</th>
                        <th class="py-2 px-4 text-right text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ $category->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">{{ $category->slug }}</td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $category->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $category->status ? __('Active') : __('Disabled') }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300">
                                <x-table.imge-cell :image="$category->image ? asset('storage/' . $category->image) : null" />
                            </td>
                            <td class="py-2 px-4 text-sm text-gray-600 dark:text-gray-300 text-right">
                                <x-table.edit-button :href="route('commerce.category.edit', $category->slug)" />
                                |
                                <x-delete-cell-button route="{{ route('commerce.category.destroy', $category->id) }}"  />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                @if ($categories->hasPages())
                    {{ $categories->links() }}
                @endif
            </div>
        </div>
    </div>
</x-commerce::layouts.master>