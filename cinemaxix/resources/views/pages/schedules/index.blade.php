@extends('layouts.app', ['title' => 'Schedule'])

@section('content')
    <section class="p-10">
        <div class="mb-10 inline-flex justify-between items-center w-full">
            <div>
                <h1 class="text-5xl font-extrabold dark:text-white mb-5">Schedules</h1>
                <x-breadcrumb />
            </div>
        </div>

        <form class="flex gap-5 mb-5 items-end">
            <div>
                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                <select id="branch" name="branch"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option selected value="">Choose a branch</option>
                    @foreach ($branches as $branch)
                        <option @selected($branch->id == request()->query('branch')) value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <input type="date" id="date" name="date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ request()->query('date') ?? null }}">
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
            @if (request()->query('branch') || request()->query('date'))
                <a type="button" href="{{ route('schedules.index') }}"
                    class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Clear
                    Search</a @endif

        </form>

        @if (!request()->query('branch'))
            <div class="w-full grid grid-cols-4 gap-5 mx-auto">
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
        @else
            <div class="flex flex-col gap-10">
                @if (!$studios_group->isEmpty())
                    @foreach ($studios_group as $studio)
                        <div>
                            <h2 class="text-4xl font-bold dark:text-white mb-5">{{ $studio->name }}</h2>
                            <div class="flex gap-5 flex-col">
                                @foreach ($studio->schedules as $schedules)
                                    <div
                                        class="flex items-start bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 w-full">
                                        <div class="object-cover aspect-[2/3] w-96 overflow-hidden bg-red-500 rounded-l-lg">
                                            <img class="w-full h-full object-cover"
                                                src="{{ $schedules[0]->movie->picture_url }}"
                                                alt="{{ $schedules[0]->movie->name }}">
                                        </div>
                                        <div class="flex flex-col justify-between p-8 w-full gap-10">

                                            <div>
                                                <h3 class="text-3xl font-bold dark:text-white mb-3">
                                                    {{ $schedules[0]->movie->name }}
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400"><span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                        <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        10 Minutes
                                                    </span></p>
                                            </div>

                                            <div class="flex flex-wrap gap-3">
                                                @foreach ($schedules as $schedule)
                                                    <div class="p-5 rounded text-left gap-3 text-white-500 bg-yellow-500">
                                                        <h5 class="text-xl font-bold mb-1 text-white">Schedule
                                                            {{ $loop->iteration }}</h5>
                                                        <div
                                                            class="grid text-sm grid-cols-2 gap-x-5 text-white dark gap-y-1">
                                                            <p>Price</p>
                                                            <p>Rp{{ number_format($schedule->price, 0) }}</p>
                                                            <p>Start Time</p>
                                                            <p>
                                                                {{ (new \Carbon\Carbon($schedule->start))->format('j F y, H:i') }}
                                                            </p>
                                                            <p>End Time</p>
                                                            <p>
                                                                {{ (new \Carbon\Carbon($schedule->end))->format('j F y, H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-4 mb-4 text-blue-800 max-w-max border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                        role="alert">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <h3 class="text-lg font-medium">Info</h3>
                        </div>
                        <div class="mt-2 text-sm">
                            Sorry, there is no schedule found for now.
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </section>
@endsection
