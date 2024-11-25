<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- Fix: Changed Vite asset inclusion -->
    @vite(['resources/css/app.css', 'resources/js/app.js',
    'resources/js/app.jsx'])

    <script src="{{ asset('js/init-alpine.js') }}"></script>
  </head>
  <body class="overflow-hidden">
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <x-header></x-header>
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
          >
            Dashboard
          </h2>

          <!-- Cards Status-->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
            <!-- Card Total Notes-->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Notes</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $totalNotes }}
                    </p>
                </div>
            </div>

            <!-- Card Total Schedule-->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Schedules</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $totalSchedules }}
                    </p>
                </div>
            </div>

            <!-- Card Total Tags -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Tags</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $totalTags }}
                    </p>
                </div>
            </div>
          </div>

          <!-- Schedules section -->
          <div class="flex justify-between items-center my-6">
              <div class="flex items-center gap-4">
                  <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                      Recent Schedules
                  </h2>
                  <a href="{{ route('schedules.index') }}" 
                     class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 dark:bg-purple-600 dark:hover:bg-purple-700 transition-colors duration-150">
                      Manage
                  </a>
              </div>
          </div>
          <div class="w-full overflow-hidden bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
              <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-nowrap">
                      <thead>
                          <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                              <th class="px-4 py-3 w-1/3">Title</th>
                              <th class="px-4 py-3 w-1/6">Description</th>
                              <th class="px-4 py-3 w-1/6">Tags</th>
                              <th class="px-4 py-3 w-1/6 text-center">Date & Time</th>
                          </tr>
                      </thead>
                      <tbody class="divide-y dark:divide-gray-700">
                          @forelse($schedules as $schedule)
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
                          </tr>
                          @empty
                          <tr>
                              <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                  No schedules found
                              </td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>

          <!-- Latest Note section -->
          <div class="flex justify-between items-center my-6">
              <div class="flex items-center gap-4">
                  <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                      Latest Note
                  </h2>
                  <a href="{{ route('notes.index') }}" 
                     class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 dark:bg-purple-600 dark:hover:bg-purple-700 transition-colors duration-150">
                      Manage
                  </a>
              </div>
          </div>
          <div class="w-full">
              @if($notes->isNotEmpty())
              <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                  <div class="flex justify-between items-center mb-4">
                      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                          {{ $notes->first()->title }}
                      </h3>
                      <span class="text-sm text-gray-500 dark:text-gray-400">
                          {{ $notes->first()->created_at->format('d M Y') }}
                      </span>
                  </div>
                  <p class="text-gray-600 dark:text-gray-400">
                      {{ Str::limit($notes->first()->content, 200) }}
                  </p>
              </div>
              @else
              <div class="text-center text-gray-500 dark:text-gray-400">
                  No notes found
              </div>
              @endif
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
