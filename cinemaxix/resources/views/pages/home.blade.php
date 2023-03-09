@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <section class="p-10">
        <div class="text-center h-[80vh] flex justify-center items-center flex-col">
            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Schedule of Trending Movie</h1>
            <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here at
                Just slite to the this website, we provide you with the latest trending movies and series, so you can watch
                and enjoy it with your family and friends.
            </p>
            <a href="{{ route('schedules.index') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                See schedule
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="w-full grid grid-cols-4 gap-5 mx-auto mt-16">
            @foreach ($movies as $movie)
                <div
                    class="max-w-sm bg-white border border-gray-200 h-full rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-t-lg aspect-[2/3] w-full object-cover" src="{{ $movie->picture_url }}"
                        alt="{{ $movie->name }}" />
                    <div class="p-5 text-center">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $movie->name }}</h5>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><span
                                class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $movie->minute_length }} Minutes
                            </span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
