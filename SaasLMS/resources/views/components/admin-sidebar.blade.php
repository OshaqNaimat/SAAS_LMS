<x-layout>
    <aside
        class="w-64 bg-[#0a0c10] border-r border-[#1f2937] flex flex-col justify-between h-screen sticky top-0 text-[#9ca3af]">
        <div>
            <div class="p-6 border-b border-[#1f2937] flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-[#06b6d4] flex items-center justify-center text-white text-lg shadow-lg shadow-cyan-500/20">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-sm tracking-wide">Admin Portal</h2>
                    <p class="text-xs text-gray-500">Institution Management</p>
                </div>
            </div>

            <nav class="p-4 space-y-1.5">
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 bg-[#2563eb] text-white rounded-xl font-medium transition-all duration-200">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a href="#"
                    class="flex items-center justify-between px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-person-video3 group-hover:text-[#06b6d4]"></i>
                        <span class="text-sm">Teachers</span>
                    </div>
                    <span
                        class="bg-[#111827] text-blue-500 text-xs font-semibold px-2 py-0.5 rounded-md border border-blue-500/20">24</span>
                </a>
                <a href="#"
                    class="flex items-center justify-between px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-people group-hover:text-[#06b6d4]"></i>
                        <span class="text-sm">Students</span>
                    </div>
                    <span
                        class="bg-[#111827] text-purple-400 text-xs font-semibold px-2 py-0.5 rounded-md border border-purple-500/20">486</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <i class="bi bi-book group-hover:text-[#06b6d4]"></i>
                    <span class="text-sm">Courses</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <i class="bi bi-calendar3 group-hover:text-[#06b6d4]"></i>
                    <span class="text-sm">Schedule</span>
                </a>
                <a href="#"
                    class="flex items-center justify-between px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-chat-left-text group-hover:text-[#06b6d4]"></i>
                        <span class="text-sm">Messages</span>
                    </div>
                    <span
                        class="bg-[#111827] text-blue-500 text-xs font-semibold px-2 py-0.5 rounded-md border border-blue-500/20">3</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-[#111827] hover:text-white rounded-xl transition-all duration-200 group">
                    <i class="bi bi-file-earmark-bar-graph group-hover:text-[#06b6d4]"></i>
                    <span class="text-sm">Reports</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-[#1f2937] bg-[#0d1117]">
            <div
                class="flex items-center justify-between p-2 rounded-xl hover:bg-[#161b22] transition-colors duration-200">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center font-bold text-sm">
                        S
                    </div>
                    <div class="truncate max-w-[110px]">
                        <h4 class="text-white text-xs font-semibold truncate">Sarah Johnson</h4>
                        <p class="text-[10px] text-gray-500 truncate">Administrator</p>
                    </div>
                </div>
                <button class="text-gray-500 hover:text-red-400 p-1.5 rounded-lg transition-colors">
                    <i class="bi bi-box-arrow-right text-lg"></i>
                </button>
            </div>
        </div>
    </aside>
</x-layout>
