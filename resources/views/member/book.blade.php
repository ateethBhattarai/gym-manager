<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-2xl divide-y">
                    @forelse ($scheduleClasses as $class)
                        <div class="py-6">
                            <div class="flex gap-6 justify-between">
                                <div>
                                    <p class="text-xl font-semibold text-purple-700">
                                        {{ $class->classType->name }}</p>
                                    <p class="text-sm">{{ $class->instructor->name }}</p>
                                    <p class="mt-2 mb-4 text-xl">{{ $class->classType->description }}</p>
                                    <span class="text-slate-600 text-sm">{{ $class->classType->duration }}
                                        minutes</span>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                                    <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                                </div>
                            </div>
                            <div class="mt-1 text-right">
                                <form method="post" action="{{ route('bookings.store') }}">
                                    @csrf
                                    <input type="hidden" name="schedule_class_id" value="{{ $class->id }}">
                                    <x-primary-button class="px-3 py-1">Book</x-primary-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div>
                            <p>No classes are scheduled. Check back later!!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
