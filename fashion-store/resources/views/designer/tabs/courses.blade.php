<div class="tab-content hidden" id="courses-tab">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 sm:mb-0">Courses Management</h3>
            <button onclick="showModal('course-modal')" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add New Course
            </button>
        </div>
        
        <!-- Search Bar -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="course-search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Search courses...">
            </div>
        </div>
        
        <!-- Courses Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="courses-tbody">
                    @forelse($courses ?? [] as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($course->image)
                                            <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-graduation-cap text-blue-600"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($course->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($course->level ?? 'N/A') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($course->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $course->enrollments->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $course->duration ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="viewCourse({{ $course->id }})" class="text-blue-600 hover:text-blue-900 p-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editCourse({{ $course->id }})" class="text-green-600 hover:text-green-900 p-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteCourse({{ $course->id }})" class="text-red-600 hover:text-red-900 p-1" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-graduation-cap text-4xl text-gray-300 mb-2"></i>
                                    <p>No courses found</p>
                                    <p class="text-sm">Click "Add New Course" to create your first course</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Course Modal -->
<div id="view-course-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 modal-backdrop">
    <div class="relative top-10 mx-auto p-5 border max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Course Details</h3>
                <button onclick="hideModal('view-course-modal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="course-details-content" class="space-y-6">
                <!-- Course details will be loaded here -->
            </div>
            
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <button type="button" onclick="hideModal('view-course-modal')" 
                        class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Close
                </button>
                <button type="button" onclick="editCourseFromView()" id="edit-from-view-btn"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i>Edit Course
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div id="edit-course-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 modal-backdrop">
    <div class="relative top-10 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Course</h3>
                <button onclick="hideModal('edit-course-modal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="edit-course-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                    <input type="text" name="title" id="edit-title" placeholder="Enter course title" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                    <select name="level" id="edit-level"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">Select level</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                        <option value="specialized">Specialized</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" name="price" id="edit-price" step="0.01" placeholder="0.00" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                        <input type="text" name="duration" id="edit-duration" placeholder="e.g. 4 weeks" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="edit-description" rows="3" placeholder="Course description" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Course Image</label>
                    <input type="file" name="image" accept="image/*" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="hideModal('edit-course-modal')" 
                            class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fas fa-save mr-2"></i>Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentCourseId = null;

function viewCourse(courseId) {
    currentCourseId = courseId;
    
    // Show loading state
    document.getElementById('course-details-content').innerHTML = `
        <div class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
        </div>
    `;
    
    showModal('view-course-modal');
    
    // Fetch course data
    fetch(`/designer/courses/${courseId}`)
        .then(response => response.json())
        .then(course => {
            displayCourseDetails(course);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('course-details-content').innerHTML = `
                <div class="text-center text-red-500 py-8">
                    <i class="fas fa-exclamation-triangle text-4xl mb-2"></i>
                    <p>Error loading course details</p>
                </div>
            `;
        });
}

function displayCourseDetails(course) {
    const enrollmentsList = course.enrollments && course.enrollments.length > 0 
        ? course.enrollments.map(enrollment => `
            <div class="flex items-center space-x-2 p-2 bg-gray-50 rounded">
                <i class="fas fa-user text-blue-500"></i>
                <span class="text-sm">${enrollment.user ? enrollment.user.name : 'Unknown User'}</span>
            </div>
          `).join('')
        : '<p class="text-gray-500 text-sm">No enrollments yet</p>';

    document.getElementById('course-details-content').innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Course Image -->
            <div class="space-y-4">
                <div class="aspect-video rounded-lg overflow-hidden bg-gray-100">
                    ${course.image 
                        ? `<img src="/storage/${course.image}" alt="${course.title}" class="w-full h-full object-cover">`
                        : `<div class="w-full h-full flex items-center justify-center">
                             <i class="fas fa-graduation-cap text-6xl text-gray-400"></i>
                           </div>`
                    }
                </div>
                
                <!-- Course Stats -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-3 rounded-lg text-center">
                        <div class="text-2xl font-bold text-blue-600">${course.enrollments ? course.enrollments.length : 0}</div>
                        <div class="text-sm text-blue-800">Students</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg text-center">
                        <div class="text-2xl font-bold text-green-600">$${course.price ? parseFloat(course.price).toFixed(2) : '0.00'}</div>
                        <div class="text-sm text-green-800">Price</div>
                    </div>
                </div>
            </div>
            
            <!-- Course Details -->
            <div class="space-y-4">
                <div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">${course.title}</h4>
                    <div class="flex items-center space-x-4 text-sm text-gray-600 mb-3">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">${course.level ? course.level.charAt(0).toUpperCase() + course.level.slice(1) : 'N/A'}</span>
                        ${course.duration ? `<span><i class="fas fa-clock mr-1"></i>${course.duration}</span>` : ''}
                        ${course.language ? `<span><i class="fas fa-globe mr-1"></i>${course.language}</span>` : ''}
                    </div>
                </div>
                
                <div>
                    <h5 class="font-medium text-gray-900 mb-2">Description</h5>
                    <p class="text-gray-700 text-sm leading-relaxed">${course.description || 'No description provided'}</p>
                </div>
                
                ${course.lessons_count ? `
                <div>
                    <h5 class="font-medium text-gray-900 mb-2">Course Details</h5>
                    <div class="text-sm text-gray-600">
                        <span><i class="fas fa-play-circle mr-2"></i>${course.lessons_count} Lessons</span>
                    </div>
                </div>
                ` : ''}
                
                ${course.video_url || course.preview_url ? `
                <div>
                    <h5 class="font-medium text-gray-900 mb-2">Links</h5>
                    <div class="space-y-2">
                        ${course.video_url ? `<a href="${course.video_url}" target="_blank" class="block text-blue-600 hover:text-blue-800 text-sm"><i class="fas fa-video mr-2"></i>Course Video</a>` : ''}
                        ${course.preview_url ? `<a href="${course.preview_url}" target="_blank" class="block text-blue-600 hover:text-blue-800 text-sm"><i class="fas fa-eye mr-2"></i>Preview</a>` : ''}
                    </div>
                </div>
                ` : ''}
                
                ${course.start_date ? `
                <div>
                    <h5 class="font-medium text-gray-900 mb-2">Start Date</h5>
                    <p class="text-sm text-gray-600">${new Date(course.start_date).toLocaleDateString()}</p>
                </div>
                ` : ''}
            </div>
        </div>
        
        <!-- Enrolled Students -->
        <div class="mt-6">
            <h5 class="font-medium text-gray-900 mb-3">Enrolled Students (${course.enrollments ? course.enrollments.length : 0})</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-40 overflow-y-auto">
                ${enrollmentsList}
            </div>
        </div>
    `;
}

function editCourseFromView() {
    if (currentCourseId) {
        hideModal('view-course-modal');
        editCourse(currentCourseId);
    }
}

function editCourse(courseId) {
    // Fetch course data and populate the edit form
    fetch(`/designer/courses/${courseId}`)
        .then(response => response.json())
        .then(course => {
            document.getElementById('edit-title').value = course.title;
            document.getElementById('edit-level').value = course.level;
            document.getElementById('edit-price').value = course.price;
            document.getElementById('edit-duration').value = course.duration || '';
            document.getElementById('edit-description').value = course.description || '';
            
            // Set form action
            document.getElementById('edit-course-form').action = `/designer/courses/${courseId}`;
            
            showModal('edit-course-modal');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading course data');
        });
}

function deleteCourse(courseId) {
    if (confirm('Are you sure you want to delete this course?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/designer/courses/${courseId}`;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.innerHTML = `
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="DELETE">
        `;
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Search functionality
document.getElementById('course-search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#courses-tbody tr');
    
    rows.forEach(row => {
        // Check if this is the "no courses" row
        if (row.querySelector('td[colspan]')) {
            return; // Skip the empty state row
        }
        
        const nameElement = row.querySelector('td:first-child .text-sm.font-medium');
        const levelElement = row.querySelector('td:nth-child(2)');
        
        if (nameElement && levelElement) {
            const courseName = nameElement.textContent.toLowerCase();
            const level = levelElement.textContent.toLowerCase();
            
            if (courseName.includes(searchTerm) || level.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>