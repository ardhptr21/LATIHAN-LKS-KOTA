@extends('layouts.app', ['title' => 'Edit Schedule'])

@section('content')
    <section class="p-10">
        <div class="mb-10">
            <div>
                <h1 class="text-5xl font-extrabold dark:text-white mb-5">Schedules</h1>
                <x-breadcrumb />
            </div>
        </div>

        <form action="{{ route('schedules.update', $schedule) }}" class="mb-6 max-w-2xl mx-auto" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="studio_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie</label>
                <select id="studio_id" name="studio_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($studios as $studio)
                        <option @selected($studio->id == $schedule->studio->id) value="{{ $studio->id }}">{{ $studio->name }}</option>
                    @endforeach
                </select>
                @error('stdio_id')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="movie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie</label>
                <select id="movie_id" name="movie_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($movies as $movie)
                        <option @selected($movie->id == $schedule->movie->id) value="{{ $movie->id }}">{{ $movie->name }}</option>
                    @endforeach
                </select>
                @error('movie_id')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                    Schedule</label>
                <input type="datetime-local" id="start" name="start"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required value="{{ $schedule->start }}">
                @error('start')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="inline-flex">
                <a href="{{ route('schedules.index') }}"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Cancel</a>
                <button type="submit"
                    class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
            </div>
        </form>
    </section>
@endsection
