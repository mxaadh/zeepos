<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sales Invoice
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-around align-middle gap-4">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('invoices.partials.form')
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('invoices.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-6">
                <!-- First box -->
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="text-gray-900 dark:text-gray-100">
                        @include('invoices.partials.form')
                    </div>
                </div>

                <!-- Second box -->
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="text-gray-900 dark:text-gray-100">
                        @include('invoices.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</x-app-layout>
