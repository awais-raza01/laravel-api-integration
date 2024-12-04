@extends('component.index')
@section('section')
<form action="{{ route('category.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    @csrf

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

    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Add Category</h1>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter category name" required>
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit</button>
</form>

@endsection


