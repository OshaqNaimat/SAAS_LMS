<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-teacher-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Assigned Classes</h1>
                    <p class="text-sm text-gray-400">Overview of your academic rooms, total student counts, and sections
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <span
                        class="text-xs bg-blue-500/10 border border-blue-500/20 text-blue-400 font-semibold px-4 py-2 rounded-xl">
                        Total Enrolled: {{ $totalEnrolled }} Students
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold text-gray-400 tracking-wide uppercase mb-2">Active Academic Rooms</h3>

                    @php
                        $colors = [
                            ['bg' => 'bg-blue-500/10', 'border' => 'border-blue-500/20', 'text' => 'text-blue-400'],
                            [
                                'bg' => 'bg-emerald-500/10',
                                'border' => 'border-emerald-500/20',
                                'text' => 'text-emerald-400',
                            ],
                            ['bg' => 'bg-amber-500/10', 'border' => 'border-amber-500/20', 'text' => 'text-amber-400'],
                            [
                                'bg' => 'bg-purple-500/10',
                                'border' => 'border-purple-500/20',
                                'text' => 'text-purple-400',
                            ],
                        ];
                    @endphp

                    @forelse($classes as $i => $class)
                        @php $color = $colors[$i % count($colors)]; @endphp
                        <div
                            class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-700 transition">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl {{ $color['bg'] }} border {{ $color['border'] }} {{ $color['text'] }} flex items-center justify-center text-xl shrink-0">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-base font-bold text-white">{{ $class->name }} - Section
                                            {{ $class->section }}</h4>
                                        @if ($i === 0)
                                            <span
                                                class="text-[10px] px-2 py-0.5 rounded font-bold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Main
                                                Room</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        @if ($class->stream)
                                            Subject: {{ $class->stream }} •
                                        @endif
                                        Room No. {{ $class->room ?? 'N/A' }}
                                    </p>
                                    <p class="text-[11px] text-gray-500 mt-1">
                                        <i class="bi bi-person-badge"></i> Class Strength: {{ $class->studentCount() }}
                                        Enrolled
                                    </p>
                                </div>
                            </div>
                            <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 w-full sm:w-auto">
                                <a href="{{ route('teacher.attendance', ['class_id' => $class->id]) }}"
                                    class="w-full sm:w-auto text-center px-3 py-1.5 bg-slate-900 border border-slate-800 hover:border-emerald-500/40 text-xs font-semibold rounded-lg text-gray-300 hover:text-white transition">
                                    View Attendance
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-8 text-center">
                            <p class="text-sm text-gray-500">No classes assigned yet. Contact admin.</p>
                        </div>
                    @endforelse
                </div>

                <div class="space-y-6">
                    <div class="bg-slate-900/40 border border-dashed border-slate-800 rounded-2xl p-4">
                        <span class="text-xs font-bold text-white flex items-center gap-1.5">
                            <i class="bi bi-info-circle text-blue-400"></i> Tip for Teachers
                        </span>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">
                            Need to make adjustments to your room schedules or swap sections? Please contact the
                            coordination desk.
                        </p>
                    </div>
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
