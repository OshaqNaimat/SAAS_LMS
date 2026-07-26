<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Daily Timetable</h1>
                    <p class="text-sm text-gray-400">
                        {{ ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'][$selectedDay] }},
                        {{ now()->format('d F Y') }}</p>
                </div>
                <div class="flex gap-2">
                    <div class="bg-[#111c2a] border border-slate-800 rounded-xl px-4 py-2">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Total Lectures</span>
                        <span class="text-sm font-bold text-white">{{ $totalToday }} Today</span>
                    </div>
                    <div class="bg-[#111c2a] border border-slate-800 rounded-xl px-4 py-2">
                        <span class="text-[10px] text-gray-500 uppercase block font-bold">Work Load</span>
                        <span class="text-sm font-bold text-emerald-400">{{ $workloadHours }} Hours</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">

                    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                        @foreach (['Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6] as $label => $dayNum)
                            <a href="{{ route('teacher.Schedule', ['day' => $dayNum]) }}"
                                class="px-4 py-2 text-xs font-semibold rounded-xl shrink-0 {{ $selectedDay == $dayNum ? 'bg-blue-600 text-white border border-blue-500/50 shadow-lg shadow-blue-600/20' : 'bg-[#111c2a] text-gray-400 border border-slate-800' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                    <div class="space-y-3">
                        @forelse($periods as $period)
                            @php
                                $statusStyles = [
                                    'done' => ['border-slate-800', 'bg-slate-900', 'text-gray-500', 'Done'],
                                    'ongoing' => [
                                        'border-emerald-500/40 bg-emerald-500/[0.02] shadow-xl',
                                        'bg-emerald-500/10 border-emerald-500/20',
                                        'text-emerald-400',
                                        'On-going',
                                    ],
                                    'upcoming' => ['border-slate-800', 'bg-slate-900', 'text-blue-400', 'Up Next'],
                                    'scheduled' => [
                                        'border-slate-800 opacity-70',
                                        'bg-slate-900',
                                        'text-gray-500',
                                        'Later',
                                    ],
                                ];
                                [$cardClass, $iconBg, $textColor, $label] = $statusStyles[$period->computedStatus];
                            @endphp
                            <div
                                class="bg-[#111c2a] border {{ $cardClass }} rounded-2xl p-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl {{ $iconBg }} border flex flex-col items-center justify-center">
                                        <span
                                            class="text-[10px] {{ $textColor }} font-bold">{{ $period->period_number }}{{ $period->period_number == 1 ? 'st' : ($period->period_number == 2 ? 'nd' : ($period->period_number == 3 ? 'rd' : 'th')) }}</span>
                                        <span
                                            class="text-xs {{ $textColor === 'text-gray-500' ? 'text-white' : $textColor }} font-bold">{{ \Carbon\Carbon::parse($period->start_time)->format('H:i') }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-white">{{ $period->subject }}</h3>
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
                            <p class="text-center text-gray-500 text-sm py-8">No periods scheduled for this day.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-6">

                    {{-- <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-white">Daily Tasks</h3>
                            <button class="text-[10px] text-blue-400 font-bold hover:underline">Add New</button>
                        </div>
                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-400 group-hover:text-white transition">Mark Attendance
                                    (10-A)</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox" checked
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-500 line-through">Submit Weekly Report</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-800 cursor-pointer group">
                                <input type="checkbox"
                                    class="rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-0">
                                <span class="text-xs text-gray-400 group-hover:text-white transition">Check Maths
                                    Homework</span>
                            </label>
                        </div>
                    </div> --}}

                    {{-- <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-sm font-bold text-white mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-amber-500 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-white">10</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Parent-Teacher Meeting</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">8:00 AM — 12:00 PM</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[9px] font-bold text-blue-500 uppercase">Jun</span>
                                    <span class="text-xs font-bold text-white">15</span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Summer Vacation Starts</h4>
                                    <p class="text-[10px] text-gray-500 mt-0.5">Full Day Event</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div
                        class="bg-gradient-to-br from-blue-600/20 to-emerald-600/20 border border-blue-500/20 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="bi bi-gift text-amber-400"></i>
                            <h3 class="text-sm font-bold text-white">Student Birthdays</h3>
                        </div>
                        <p class="text-xs text-gray-400 mb-0.5">Zayn Malik (Class 10-A)</p>
                        <p class="text-[10px] text-blue-400 font-semibold">Today! 🎂</p>
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
