{{-- resources/views/notes/create.blade.php --}}
<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Note - SchedNote</title>
    
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
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Create New Note
                    </h2>

                    <!-- Form Card -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <form action="{{ route('notes.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Title
                                </label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Content
                                </label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="6"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea"
                                ></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tags
                                </label>
                                <select name="tags[]" multiple class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-multiselect">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center">
                                <button 
                                    type="submit"
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                >
                                    Save Note
                                </button>
                                
                                <a 
                                    href="{{ route('notes.index') }}"
                                    class="ml-4 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                                >
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>