<!-- resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Profile</title>

    <!-- Fonts and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-hidden font-sans antialiased bg-gray-100">
    <div class="min-h-screen">

        <!-- Header 1 -->
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800" x-data="{ isProfileMenuOpen: false }">
            <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                <!-- Mobile hamburger -->
                <a class="ml-2 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ route('dashboard') }}">
                    SchedNote.
                  </a>
                <button
                    class="inline-flex items-center px-3 py-2 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                    @click="$dispatch('toggle-sidebar')"
                    aria-label="Menu"
                >
                    <svg
                        class="w-6 h-6"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
        
                <!-- Profile menu -->
                <div class="relative ml-auto">
                    <button
                        class="flex items-center align-middle focus:shadow-outline-purple focus:outline-none"
                        @click="isProfileMenuOpen = !isProfileMenuOpen"
                        @keydown.escape="isProfileMenuOpen = false"
                        aria-label="Account"
                        aria-haspopup="true"
                    >
                        <span class="mr-1 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            {{ Auth::user()->name }}
                        </span>
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
        
                    <div
                        x-show="isProfileMenuOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        @click.away="isProfileMenuOpen = false"
                        @keydown.escape="isProfileMenuOpen = false"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                        aria-label="submenu"
                    >
                        <!-- Profile -->
                        <a
                            class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                            href="{{ Route('dashboard') }}"
                        >
                        <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                            <span>Dashboard</span>
                        </a>
        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a
                                class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                <svg
                                    class="w-4 h-4 mr-3"
                                    aria-hidden="true"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Log out</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Header 2 -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    Your Profile
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="flex justify-between">
                    <!-- Update Profile Section -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
        
                    <!-- Update Password Section -->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
        
                <!-- Delete User Section Centered -->
                <div class="flex justify-center">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div>
</body>
</html>
