{{-- resources/views/notes/index.blade.php --}}
<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notes - SchedNote</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 overflow-hidden">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop & Mobile Sidebar -->
        @include('components.header')

        <div class="flex flex-col flex-1">
            <!-- Main Content -->
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <div class="flex items-center gap-4 my-8">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                            Your Notes
                        </h2>
                        
                        <a href="{{ route('notes.create') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 transition-colors">
                            Create New Note
                        </a>
                    </div>

                    @if($notes->isEmpty())
                        <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                            <p class="text-gray-600 dark:text-gray-400">No notes available.</p>
                        </div>
                    @else
                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($notes as $note)
                                <div class="flex flex-col h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start gap-4">
                                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                                {{ $note->title }}
                                            </h3>
                                            <div class="flex flex-wrap gap-2">
                                                @if($note->tags->isNotEmpty())
                                                    @foreach($note->tags as $tag)
                                                        <span class="px-2.5 py-1 text-xs font-medium bg-purple-600 text-white rounded-full">
                                                            {{ $tag->tag_name }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span class="text-xs text-gray-500">No tags</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="mt-4 mb-6 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4 line-clamp-3 overflow-hidden">
                                            {{ Str::limit($note->content, 290) }}
                                        </p>
                                    </div>
                                    
                                    <div class="flex gap-3 mt-auto pt-2">
                                        <a href="{{ route('notes.show', $note) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 focus:ring-2 focus:ring-purple-300 transition-colors">
                                            View
                                        </a>
                                        <a href="{{ route('notes.edit', $note) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-700 focus:ring-2 focus:ring-yellow-300 transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-300 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this note?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 px-4">
                            {{ $notes->links() }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>