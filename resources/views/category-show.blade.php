@extends('component.index')
@section('section')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="container mx-auto p-4">
        @if (isset($categories) && count($categories) > 0)
            <h1 class="text-gray-800 text-center font-medium my-2 text-xl">Category List </h1>
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Category Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th> <!-- New column for buttons -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $category['name'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <!-- Update Button -->
                                <button type="button"
                                        onclick="openModal({{ $category['id'] }}, '{{ $category['name'] }}')"
                                        class="text-blue-500 hover:text-blue-700 mr-2">
                                    Update
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('category.destroy', $category['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-red-500">No categories available.</p>
        @endif
    </div>
    <div id="updateModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <form id="updateCategoryForm" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function openModal(id, name) {
        const modal = document.getElementById('updateModal');
        const form = document.getElementById('updateCategoryForm');
        const nameInput = document.getElementById('name');

        form.action = '/category/edit/' + id; // Adjust according to your route
        nameInput.value = name;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('updateModal');
        modal.classList.add('hidden');
    }
</script>


@endsection
