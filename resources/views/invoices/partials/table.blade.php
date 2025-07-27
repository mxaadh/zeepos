<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Invoice Table
        </h2>
    </header>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-2 border-b text-left">#</th>
                <th class="px-4 py-2 border-b text-left">Item Number</th>
                <th class="px-4 py-2 border-b text-left">Item Name</th>
                <th class="px-4 py-2 border-b text-left">Description</th>
                <th class="px-4 py-2 border-b text-left">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900">
            <!-- Example row -->
            <tr>
                <td class="px-4 py-2 border-b">1</td>
                <td class="px-4 py-2 border-b">001</td>
                <td class="px-4 py-2 border-b">Product A</td>
                <td class="px-4 py-2 border-b">High quality item</td>
                <td class="px-4 py-2 border-b">
                    <button class="text-blue-500 hover:underline">Edit</button>
                    <button class="text-red-500 hover:underline ml-2">Delete</button>
                </td>
            </tr>
            <tr>
                <td class="px-4 py-2 border-b">1</td>
                <td class="px-4 py-2 border-b">001</td>
                <td class="px-4 py-2 border-b">Product A</td>
                <td class="px-4 py-2 border-b">High quality item</td>
                <td class="px-4 py-2 border-b">
                    <button class="text-blue-500 hover:underline">Edit</button>
                    <button class="text-red-500 hover:underline ml-2">Delete</button>
                </td>
            </tr>
            <!-- More rows can be added dynamically -->
            </tbody>
        </table>
    </div>
</section>
