{{-- resources/views/notes/show.blade.php --}}
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
<body class="overflow-hidden">
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <!-- Desktop & Mobile Sidebar -->
        @include('components.header')

        <div class="flex flex-col flex-1 w-full">
            <!-- Main Content -->
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid max-w-7xl"> <!-- Added max-w-4xl -->
                    <div class="flex flex-col gap-2 my-6"> <!-- Changed to flex-col and added gap -->
                        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $note->title }}
                        </h2>
                        <div class="flex flex-wrap gap-1">
                            @if($note->tags->isNotEmpty())
                                @foreach($note->tags as $tag)
                                    <span class="px-2 py-1 text-xs font-medium bg-purple-600 text-white rounded">
                                        {{ $tag->tag_name }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-500">No tags</span>
                            @endif
                        </div>
                    </div>

                    <!-- Note Content Card -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-hidden"> <!-- Added overflow-hidden -->
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 border-b pb-2">
                            <span class="block break-words whitespace-normal overflow-wrap-break-word"> <!-- Added overflow-wrap-break-word -->
                                {{ $note->content }}
                            </span>
                        </p>

                        <div class="flex flex-wrap items-center mt-4 gap-4"> <!-- Changed space-x-4 to gap-4 and added flex-wrap -->
                            <a 
                                href="{{ route('notes.edit', $note->id) }}"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-600 border border-transparent rounded-lg active:bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:shadow-outline-yellow"
                            >
                                Edit
                            </a>
                            
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                    onclick="return confirm('Are you sure you want to delete this note?')"
                                >
                                    Delete
                                </button>
                            </form>
                            
                            <a 
                                href="{{ route('notes.index') }}"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            >
                                Back to Notes
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>