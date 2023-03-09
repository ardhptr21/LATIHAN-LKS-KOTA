@extends('layouts.app', ['title' => 'Edit Movie'])

@section('content')
    <section class="p-10">
        <div class="mb-10">
            <div>
                <h1 class="text-5xl font-extrabold dark:text-white mb-5">Movies</h1>
                <x-breadcrumb />
            </div>
        </div>

        <form action="{{ route('movies.update', $movie) }}" class="mb-6 max-w-2xl mx-auto" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Power Rangers" value="{{ $movie->name }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="minute_length"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                <input type="number" id="minute_length" name="minute_length" min="1" max="999"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1 - 999 Minutes" value="{{ $movie->minute_length }}" required>
                @error('minute_length')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="picture">Picture
                    file</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="picture_help" id="picture" type="file" name="picture" accept="image/*">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="picture_help">JPG, JPEG, PNG (Max 2 MB) -
                    Aspect 2:3
                </p>
                @error('picture')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="inline-flex">
                <a href="{{ route('movies.index') }}" type="button"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Cancel</a>
                <button type="submit"
                    class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
            </div>
        </form>
    </section>
@endsection
