{{-- resources/views/schedules/edit.blade.php --}}
<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule - SchedNote</title>
    
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
                        Edit Schedule
                    </h2>

                    <!-- Form Card -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Title
                                </label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    value="{{ old('title', $schedule->title) }}"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    required
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Event Date
                                    </label>
                                    <input 
                                        type="date" 
                                        name="event_date" 
                                        id="event_date" 
                                        value="{{ old('event_date', $schedule->event_date) }}"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        required
                                    >
                                </div>

                                <div class="mb-4">
                                    <label for="event_time" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Time
                                    </label>
                                    <input 
                                        type="time" 
                                        name="event_time" 
                                        id="event_time" 
                                        value="{{ old('event_time', $schedule->event_time) }}"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Description
                                </label>
                                <textarea 
                                    name="description" 
                                    id="description" 
                                    rows="4"
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea"
                                >{{ old('description', $schedule->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tags
                                </label>
                                <select name="tags[]" multiple class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-multiselect">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $schedule->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $tag->tag_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center justify-end gap-4">
                                <button 
                                    type="submit"
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                >
                                    Update Schedule
                                </button>
                                
                                <a 
                                    href="{{ route('schedules.index') }}"
                                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
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