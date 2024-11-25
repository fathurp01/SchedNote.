<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

</x-app-layout>
{{-- 
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Card for Notes -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Your Notes</h3>
                @foreach ($notes as $note)
                    <div class="mb-2">
                        <h4 class="text-md font-semibold">{{ $note->title }}</h4>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($note->created_at)->format('d M Y, H:i') }}</p>
                        <a href="{{ route('notes.show', $note->id) }}" class="text-blue-500">View</a>
                    </div>
                @endforeach
                <a href="{{ route('notes.create') }}" class="text-blue-500 mt-4 block">+ New Note</a>
            </div>

            <!-- Card for Schedules -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Your Schedules</h3>
                @foreach ($schedules as $schedule)
                    <div class="mb-2">
                        <h4 class="text-md font-semibold">{{ $schedule->title }}</h4>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y, H:i') }}</p>
                        <a href="{{ route('schedules.show', $schedule->id) }}" class="text-blue-500">View</a>
                    </div>
                @endforeach
                <a href="{{ route('schedules.create') }}" class="text-blue-500 mt-4 block">+ New Schedule</a>
            </div>
        </div>
    </div>
</div> --}}
