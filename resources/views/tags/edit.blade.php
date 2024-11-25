<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tag - SchedNote</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="overflow-hidden bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop & Mobile Sidebar -->
        @include('components.header')

        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <div class="flex items-center my-8">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                            Edit Tag
                        </h2>
                    </div>

                    <div class="w-full overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                        <div class="p-6">
                            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-6">
                                    <label for="tag_name" class="block mb-2 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        Tag Name
                                    </label>
                                    <input type="text" name="tag_name" id="tag_name" 
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                        value="{{ old('tag_name', $tag->tag_name) }}"
                                        placeholder="Enter tag name">
                                    @error('tag_name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 dark:hover:bg-purple-700">
                                        Update Tag
                                    </button>
                                    <a href="{{ route('tags.index') }}"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tag Usage Statistics -->
                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <!-- Notes Usage Card -->
                        <div class="relative p-6 bg-white rounded-xl shadow-sm overflow-hidden dark:bg-gray-800 border border-gray-100 dark:border-gray-700 group hover:shadow-md transition-shadow duration-300">
                            <!-- Background Decoration -->
                            <div class="absolute right-0 top-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-blue-50 dark:bg-blue-900/20 transition-transform duration-300 group-hover:scale-110"></div>
                            
                            <div class="relative">
                                <div class="flex items-center space-x-2 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        Notes Usage
                                    </h3>
                                </div>
                                
                                <div class="flex items-baseline">
                                    @if($tag->notes()->count() > 0)
                                        <span class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ $tag->notes()->count() }}
                                        </span>
                                    @else
                                        <span class="text-3xl font-bold text-gray-400 dark:text-gray-600">
                                            0
                                        </span>
                                    @endif
                                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">notes</span>
                                </div>
                            </div>
                        </div>

                        <!-- Schedules Usage Card -->
                        <div class="relative p-6 bg-white rounded-xl shadow-sm overflow-hidden dark:bg-gray-800 border border-gray-100 dark:border-gray-700 group hover:shadow-md transition-shadow duration-300">
                            <!-- Background Decoration -->
                            <div class="absolute right-0 top-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-green-50 dark:bg-green-900/20 transition-transform duration-300 group-hover:scale-110"></div>
                            
                            <div class="relative">
                                <div class="flex items-center space-x-2 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        Schedules Usage
                                    </h3>
                                </div>
                                
                                <div class="flex items-baseline">
                                    @if($tag->schedules()->count() > 0)
                                        <span class="text-3xl font-bold text-green-600 dark:text-green-400">
                                            {{ $tag->schedules()->count() }}
                                        </span>
                                    @else
                                        <span class="text-3xl font-bold text-gray-400 dark:text-gray-600">
                                            0
                                        </span>
                                    @endif
                                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">schedules</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
