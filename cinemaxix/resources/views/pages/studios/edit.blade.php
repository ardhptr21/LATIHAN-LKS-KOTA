@extends('layouts.app', ['title' => 'Edit Studio'])

@section('content')
    <section class="p-10">
        <div class="mb-10">
            <div>
                <h1 class="text-5xl font-extrabold dark:text-white mb-5">Movies</h1>
                <x-breadcrumb />
            </div>
        </div>

        <form action="{{ route('studios.update', $studio) }}" class="mb-6 max-w-2xl mx-auto" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Java Mall Cinepolis" value="{{ $studio->name }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                <select id="branch_id" name="branch_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($branches as $branch)
                        <option @selected($branch->id == $studio->branch_id) value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                @error('branch_id')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="basic_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Basic
                    Price</label>
                <input type="number" id="basic_price" name="basic_price" min="1" max="10000000"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Rp 1 - 10000000" value="{{ $studio->basic_price }}" required>
                @error('basic_price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="additional_friday_price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Additional Friday
                    Price</label>
                <input type="number" id="additional_friday_price" name="additional_friday_price" min="1"
                    max="1000000"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Rp 1 - 1000000" value="{{ $studio->additional_friday_price }}" required>
                @error('additional_friday_price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="additional_saturday_price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Additional Saturday
                    Price</label>
                <input type="number" id="additional_saturday_price" name="additional_saturday_price" min="1"
                    max="1000000"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Rp 1 - 1000000" value="{{ $studio->additional_saturday_price }}" required>
                @error('additional_saturday_price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="additional_sunday_price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Additional Sunday
                    Price</label>
                <input type="number" id="additional_sunday_price" name="additional_sunday_price" min="1"
                    max="1000000"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Rp 1 - 1000000" value="{{ $studio->additional_sunday_price }}" required>
                @error('additional_sunday_price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="inline-flex">
                <a href="{{ route('studios.index') }}" type="button"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Cancel</a>
                <button type="submit"
                    class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
            </div>
        </form>
    </section>
@endsection
