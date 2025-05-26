<div class="tab-content hidden" id="events-tab">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 sm:mb-0">Events Management</h3>
            <button onclick="showModal('event-modal')" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add New Event
            </button>
        </div>
        
        <!-- Search Bar -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500" placeholder="Search events...">
            </div>
        </div>
        
        <!-- Events Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-lg object-cover" src="/api/placeholder/48/48" alt="Event">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Fashion Show - Spring Collection</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">May 28, 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Amman - Royal Hotel</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">42 / 100</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Upcoming</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-eye"></i></button>
                                <button class="text-green-600 hover:text-green-900 p-1"><i class="fas fa-edit"></i></button>
                                <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-lg object-cover" src="/api/placeholder/48/48" alt="Event">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Workshop - Design Basics</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">June 15, 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Amman - Creativity Center</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">18 / 30</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Upcoming</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-eye"></i></button>
                                <button class="text-green-600 hover:text-green-900 p-1"><i class="fas fa-edit"></i></button>
                                <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-lg object-cover" src="/api/placeholder/48/48" alt="Event">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Book Signing - Arab Fashion</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">August 10, 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Amman - Future Library</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0 / 50</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900 p-1"><i class="fas fa-eye"></i></button>
                                <button class="text-green-600 hover:text-green-900 p-1"><i class="fas fa-edit"></i></button>
                                <button class="text-red-600 hover:text-red-900 p-1"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100">
            <div class="flex justify-center">
                <nav class="flex space-x-2">
                    <button class="px-3 py-2 text-sm leading-4 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-2 text-sm leading-4 text-white bg-green-500 border border-green-500 rounded-md">1</button>
                    <button class="px-3 py-2 text-sm leading-4 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                    <button class="px-3 py-2 text-sm leading-4 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</div>