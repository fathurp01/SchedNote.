<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Schedules - SchedNote</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="overflow-hidden bg-gray-50 dark:bg-gray-900">
    <div
      class="flex h-screen"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <!-- Desktop & Mobile Sidebar -->
        @include('components.header')

        <div class="flex flex-col flex-1 w-full">
            <!-- Main Content -->
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <div class="flex items-center my-8">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                            Your Schedules
                        </h2>
                        
                        <a
                            href="{{ route('schedules.create') }}"
                            class="ml-4 px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-purple-600 border-2 border-purple-600 rounded-lg hover:bg-purple-700 hover:border-purple-700 focus:ring-4 focus:ring-purple-500 focus:ring-opacity-30"
                        >
                            Create New Schedule
                        </a>
                    </div>

                    @if($schedules->isEmpty())
                        <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                            <p class="text-gray-600 dark:text-gray-400 text-center">No schedules available.</p>
                        </div>
                    @else
                        <div class="w-full overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-nowrap">
                                    <thead>
                                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3 w-1/3">Title</th>
                                            <th class="px-4 py-3 w-1/6">Description</th>
                                            <th class="px-4 py-3 w-1/6">Tags</th>
                                            <th class="px-4 py-3 w-1/6 text-center">Date & Time</th>
                                            <th class="px-4 py-3 w-1/6 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y dark:divide-gray-700">
                                        @foreach($schedules->sortBy(function($schedule) {
                                            return \Carbon\Carbon::parse($schedule->event_date . ' ' . $schedule->event_time);
                                        }) as $schedule)
                                        @php
                                            $scheduleDateTime = \Carbon\Carbon::parse($schedule->event_date . ' ' . $schedule->event_time);
                                            $isPast = $scheduleDateTime->isPast();
                                        @endphp
                                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 
                                            {{ $isPast ? 'text-red-600 dark:text-red-400' : '' }}">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-3">
                                                        <span class="text-purple-600 dark:text-purple-400 text-sm font-semibold 
                                                            {{ $isPast ? 'text-red-600 dark:text-red-400' : '' }}">
                                                            {{ substr($schedule->title, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div class="truncate max-w-xs">
                                                        <p class="font-semibold text-gray-800 dark:text-gray-200 
                                                            {{ $isPast ? 'text-red-600 dark:text-red-400' : '' }}">
                                                            {{ $schedule->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="truncate max-w-xs">
                                                    <p class="text-sm {{ $isPast ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }}">
                                                        {{ $schedule->description }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($schedule->tags->isNotEmpty())
                                                    <div class="flex flex-wrap gap-1.5">
                                                        @foreach($schedule->tags as $tag)
                                                            <span class="px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300 rounded-full">
                                                                {{ $tag->tag_name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">No tags</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2 py-1 text-sm font-medium rounded-full
                                                    {{ $isPast ? 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-400' : 'bg-gray-100 dark:bg-gray-700' }}">
                                                    {{ $scheduleDateTime->format('d M Y, H:i') }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-center space-x-1">
                                                    <a href="{{ route('schedules.edit', $schedule) }}"
                                                        class="px-3 py-1 text-xs font-medium text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors duration-150">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150"
                                                            onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="px-6 py-4 border-t dark:border-gray-700">
                                {{ $schedules->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>