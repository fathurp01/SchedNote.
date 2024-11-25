<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Tag - SchedNote</title>
    
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
                            Create New Tag
                        </h2>
                    </div>

                    <div class="w-full overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                        <div class="p-6">
                            <form method="POST" action="{{ route('tags.store') }}">
                                @csrf
                                <div class="mb-6">
                                    <label for="tag_name" class="block mb-2 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        Tag Name
                                    </label>
                                    <input type="text" name="tag_name" id="tag_name" 
                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                        placeholder="Enter tag name">
                                    @error('tag_name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 dark:hover:bg-purple-700">
                                        Create Tag
                                    </button>
                                    <a href="{{ route('tags.index') }}"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
