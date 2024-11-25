<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tags - SchedNote</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="overflow-hidden bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop & Mobile Sidebar -->
        @include('components.header')

        <div class="flex flex-col flex-1 w-full">
            <!-- Main Content -->
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <div class="flex items-center my-8">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                            Your Tags
                        </h2>
                        <a href="{{ route('tags.create') }}"
                            class="ml-4 px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-purple-600 border-2 border-purple-600 rounded-lg hover:bg-purple-700 hover:border-purple-700 focus:ring-4 focus:ring-purple-500 focus:ring-opacity-30">
                            Add New Tag
                        </a>
                    </div>

                    @if($tags->isEmpty())
                        <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                            <p class="text-gray-600 dark:text-gray-400 text-center">No tags available.</p>
                        </div>
                    @else
                        <div class="w-full overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full flex-table">
                                    <thead>
                                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-8 py-3 w-2/5">Tag Name</th>
                                            <th class="px-6 py-3 w-1/5 text-center">Notes</th>
                                            <th class="px-6 py-3 w-1/5 text-center">Schedules</th>
                                            <th class="px-6 py-3 w-1/5 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y dark:divide-gray-700">
                                        @foreach ($tags as $tag)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-8 py-2.5">
                                                <span class="font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $tag->tag_name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-2.5">
                                                <div class="text-center">
                                                    @if($tag->notes_count > 0)
                                                        <span class="px-2.5 py-0.5 text-sm font-medium bg-gray-100 dark:bg-gray-700 rounded-full">
                                                            {{ $tag->notes_count }}
                                                        </span>
                                                    @else
                                                        <span class="text-sm font-medium text-gray-400 dark:text-gray-600">
                                                            0
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-2.5">
                                                <div class="text-center">
                                                    @if($tag->schedules_count > 0)
                                                        <span class="px-2.5 py-0.5 text-sm font-medium bg-gray-100 dark:bg-gray-700 rounded-full">
                                                            {{ $tag->schedules_count }}
                                                        </span>
                                                    @else
                                                        <span class="text-sm font-medium text-gray-400 dark:text-gray-600">
                                                            0
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-2.5">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <a href="{{ route('tags.edit', $tag->id) }}"
                                                        class="text-sm font-medium text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors duration-150">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150"
                                                            onclick="return confirm('Are you sure you want to delete this tag?')">
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
                                <div class="flex justify-start">
                                    {{ $tags->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>
