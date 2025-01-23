<div class="bg-white p-4 rounded-lg shadow mb-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">
        Export Activities
    </h2>

    <!-- Export Filters -->
    <form method="GET" action="{{ route('activities.export.csv') }}" class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Week Filter -->
            <div>
                <label for="week" class="block text-sm font-medium text-gray-600">Select Week</label>
                <input type="date" name="week" id="week" class="border rounded-lg w-full px-3 py-2">
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-600">Filter by Status</label>
                <select name="status" id="status" class="border rounded-lg w-full px-3 py-2">
                    <option value="">All Statuses</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <!-- Export Options -->
            <div class="flex items-end">
                <div class="flex space-x-2">
                    <!-- CSV Export Button -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Export to CSV
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form method="GET" action="{{ route('activities.export.pdf') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Week Filter -->
            <div>
                <label for="week-pdf" class="block text-sm font-medium text-gray-600">Select Week</label>
                <input type="date" name="week" id="week-pdf" class="border rounded-lg w-full px-3 py-2">
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status-pdf" class="block text-sm font-medium text-gray-600">Filter by Status</label>
                <select name="status" id="status-pdf" class="border rounded-lg w-full px-3 py-2">
                    <option value="">All Statuses</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <!-- Export Options -->
            <div class="flex items-end">
                <div class="flex space-x-2">
                    <!-- PDF Export Button -->
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                        Export to PDF
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
