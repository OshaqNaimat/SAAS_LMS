<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Daily Timetable</h1>
                    <p class="text-sm text-gray-500">
                        {{ ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'][$selectedDay] }},
                        {{ now()->format('d F Y') }}</p>
                </div>
                <div class="flex gap-2">
                    <div class="bg-white border border-gray-200 rounded-xl px-4 py-2 shadow-sm">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Total Lectures</span>
                        <span class="text-sm font-bold text-gray-900">{{ $totalToday }} Today</span>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl px-4 py-2 shadow-sm">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Work Load</span>
                        <span class="text-sm font-bold text-emerald-600">{{ $workloadHours }} Hours</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">

                    <!-- ─── DAY SELECTOR TABS ─── -->
                    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                        @foreach (['Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6] as $label => $dayNum)
                            <a href="{{ route('teacher.Schedule', ['day' => $dayNum]) }}"
                                class="px-4 py-2 text-xs font-semibold rounded-xl shrink-0 {{ $selectedDay == $dayNum ? 'bg-blue-600 text-white border border-blue-500/50 shadow-lg shadow-blue-600/20' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <!-- ─── PERIODS LIST ─── -->
                    <div class="space-y-3">
                        @forelse($periods as $period)
                            @php
                                $statusStyles = [
                                    'done' => [
                                        'border-gray-200 bg-white',
                                        'bg-gray-100 border-gray-200',
                                        'text-gray-500',
                                        'Done',
                                    ],
                                    'ongoing' => [
                                        'border-emerald-300 bg-emerald-50/30 shadow-md',
                                        'bg-emerald-100 border-emerald-300',
                                        'text-emerald-700',
                                        'On-going',
                                    ],
                                    'upcoming' => [
                                        'border-blue-300 bg-blue-50/20',
                                        'bg-blue-100 border-blue-300',
                                        'text-blue-700',
                                        'Up Next',
                                    ],
                                    'scheduled' => [
                                        'border-gray-200 bg-white opacity-70',
                                        'bg-gray-100 border-gray-200',
                                        'text-gray-400',
                                        'Later',
                                    ],
                                ];
                                [$cardClass, $iconBg, $textColor, $label] = $statusStyles[$period->computedStatus];
                            @endphp
                            <div class="border {{ $cardClass }} rounded-2xl p-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl {{ $iconBg }} border flex flex-col items-center justify-center">
                                        <span
                                            class="text-[10px] {{ $textColor }} font-bold">{{ $period->period_number }}{{ $period->period_number == 1 ? 'st' : ($period->period_number == 2 ? 'nd' : ($period->period_number == 3 ? 'rd' : 'th')) }}</span>
                                        <span
                                            class="text-xs {{ $textColor === 'text-gray-500' ? 'text-gray-700' : $textColor }} font-bold">{{ \Carbon\Carbon::parse($period->start_time)->format('H:i') }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $period->subject }}</h3>
                                        <p class="text-xs text-gray-500">
                                            {{ $period->classRoom->name }}-{{ $period->classRoom->section }} •
                                            {{ $period->room ?? 'No room set' }}</p>
                                    </div>
                                </div>
                                <span
                                    class="text-[10px] font-bold {{ $textColor }} {{ $iconBg }} px-3 py-1 rounded-full border {{ $period->computedStatus === 'ongoing' ? 'animate-pulse' : '' }}">
                                    {{ $label }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm py-8">No periods scheduled for this day.</p>
                        @endforelse
                    </div>
                </div>

                <!-- ─── RIGHT SIDEBAR ─── -->
                <div class="space-y-6">

                    {{-- Daily Tasks (commented out, but light-themed for consistency) --}}
                    {{-- <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-gray-800">Daily Tasks</h3>
                            <button class="text-[10px] text-blue-600 font-bold hover:underline">Add New</button>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer group hover:border-blue-300 transition">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-600 group-hover:text-gray-800 transition">Mark Attendance (10-A)</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer group hover:border-blue-300 transition">
                                <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-400 line-through">Submit Weekly Report</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200 cursor-pointer group hover:border-blue-300 transition">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-600 group-hover:text-gray-800 transition">Check Maths Homework</span>
                            </label>
                        </div>
                    </div> --}}

                    {{-- Upcoming Events (commented out, but light-themed for consistency) --}}
                    {{-- <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-800 mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-amber-100 border border-amber-200 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-amber-600 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-gray-700">10</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-800">Parent-Teacher Meeting</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">8:00 AM — 12:00 PM</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 border border-blue-200 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-blue-600 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-gray-700">15</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-800">Summer Vacation Starts</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">Full Day Event</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Student Birthdays (commented out, but light-themed for consistency) --}}
                    {{-- <div class="bg-gradient-to-br from-blue-100 to-emerald-100 border border-blue-200 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="bi bi-gift text-amber-500"></i>
                            <h3 class="text-sm font-bold text-gray-800">Student Birthdays</h3>
                        </div>
                        <p class="text-xs text-gray-600 mb-0.5">Zayn Malik (Class 10-A)</p>
                        <p class="text-[10px] text-blue-600 font-semibold">Today! 🎂</p>
                    </div> --}}

                </div>
            </div>
        </main>
    </div>

    <script>
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
    </script>
</x-layout>
