<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Invoice Form
        </h2>
    </header>

    <form method="POST" action="#" class="mt-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="date" :value="__('Date')" />
                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="invoice_number" :value="__('Invoice Number')" />
                <x-text-input id="invoice_number" name="invoice_number" type="text" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="invoice_type" :value="__('Invoice Type')" />
                <select id="invoice_type" name="invoice_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option>Select</option>
                    <!-- Add more options -->
                </select>
            </div>

            <div>
                <x-input-label for="party" :value="__('Party')" />
                <select id="party" name="party" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option>Select</option>
                    <!-- Add more options -->
                </select>
            </div>
        </div>

        <hr class="border-dotted border-t-2 mt-6 mb-6" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="item_number" :value="__('Item Number')" />
                <x-text-input id="item_number" name="item_number" type="text" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="item_name" :value="__('Item Name')" />
                <select id="item_name" name="item_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option>Select</option>
                    <!-- Add more options -->
                </select>
            </div>

            <div class="md:col-span-2">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div>
                <x-input-label for="qty" :value="__('Qty')" />
                <x-text-input id="qty" name="qty" type="number" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="bonus" :value="__('Bonus')" />
                <x-text-input id="bonus" name="bonus" type="number" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="rate" :value="__('Rate')" />
                <x-text-input id="rate" name="rate" type="number" step="0.01" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="discount" :value="__('Discount %')" />
                <x-text-input id="discount" name="discount" type="number" step="0.01" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="amount_exc_tax" :value="__('Amount Exc Tax')" />
                <x-text-input id="amount_exc_tax" name="amount_exc_tax" type="number" step="0.01" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="sales_tax" :value="__('Sales Tax')" />
                <x-text-input id="sales_tax" name="sales_tax" type="number" step="0.01" class="mt-1 block w-full" />
            </div>

            <div>
                <x-input-label for="amount_inc_tax" :value="__('Amount Inc Tax')" />
                <x-text-input id="amount_inc_tax" name="amount_inc_tax" type="number" step="0.01" class="mt-1 block w-full" />
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
</section>
