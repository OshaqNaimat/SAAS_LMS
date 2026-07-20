<x-layout>
    <div class="flex h-screen overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 min-h-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Billing & Fee Management</h1>
                    <p class="text-sm text-gray-400 mt-1">Track manual fee collections, verify ledger entries, and audit
                        systemic accounts.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <button onclick="toggleModal('collectionModal')"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                        <i class="bi bi-plus-lg"></i> Record Manual Payment
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Total Collected (Term)</span>
                        <h4 class="text-2xl font-bold text-white tracking-tight">PKR
                            {{ number_format($totalCollected) }}</h4>
                        <span class="text-[11px] text-emerald-400 flex items-center gap-1"><i
                                class="bi bi-arrow-up-short"></i> {{ $collectedPct }}% of total invoices</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Outstanding Receivables</span>
                        <h4 class="text-2xl font-bold text-amber-400 tracking-tight">PKR
                            {{ number_format($outstanding) }}</h4>
                        <span class="text-[11px] text-amber-400 flex items-center gap-1"><i class="bi bi-clock"></i>
                            {{ $pendingCount }} Pending invoices</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-xl">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Overdue Accounts</span>
                        <h4 class="text-2xl font-bold text-rose-400 tracking-tight">{{ $overdueCount }} Cases</h4>
                        <span class="text-[11px] text-rose-400 flex items-center gap-1">Grace periods expired</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 text-xl">
                        <i class="bi bi-exclamation-octagon"></i>
                    </div>
                </div>
                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-medium">Bank Transfer Cleared</span>
                        <h4 class="text-2xl font-bold text-blue-400 tracking-tight">{{ $bankPct }}%</h4>
                        <span class="text-[11px] text-gray-400">vs {{ $cashPct }}% Direct Cash</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl">
                        <i class="bi bi-bank"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="lg:col-span-2 bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-sm font-bold text-white">Collections by Fee Category</h3>
                            <p class="text-xs text-gray-400">Analysis of capital weightings across systemic items</p>
                        </div>
                        <span
                            class="text-[10px] uppercase font-bold text-blue-400 bg-blue-500/10 border border-blue-500/20 px-2.5 py-1 rounded-md">Q2
                            Baseline</span>
                    </div>

                    <div class="flex items-end justify-between h-44 pt-4 px-4 border-b border-slate-800/80 gap-6">
                        @foreach ($categoryTotals as $cat => $pct)
                            <div class="w-1/4 flex flex-col items-center gap-2 h-full justify-end group">
                                <div class="w-full max-w-[48px] {{ $cat === 'Sports / Lab' ? 'bg-amber-500/40 group-hover:bg-amber-500' : 'bg-blue-600/40 group-hover:bg-blue-600' }} rounded-t-md transition-all"
                                    style="height: {{ $pct }}%"></div>
                                <span
                                    class="text-[11px] {{ $cat === 'Sports / Lab' ? 'text-amber-400' : 'text-gray-400' }}">{{ $cat }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#111c2a] border border-slate-800 rounded-2xl p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-white mb-1">Collection Channels</h3>
                        <p class="text-xs text-gray-400">Breakdown of clearing methods chosen by targets</p>
                    </div>
                    <div class="space-y-4 py-2">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Bank Deposit Challan</span>
                                <span class="text-white font-medium">{{ $channelTotals['Bank Deposit (HBL)'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-blue-500 h-full"
                                    style="width: {{ $channelTotals['Bank Deposit (HBL)'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Direct Over-Counter Cash</span>
                                <span class="text-white font-medium">{{ $channelTotals['Cash Counter'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full"
                                    style="width: {{ $channelTotals['Cash Counter'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Pay Order / Check Drop</span>
                                <span class="text-white font-medium">{{ $channelTotals['Pay Order'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full" style="width: {{ $channelTotals['Pay Order'] }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-[11px] text-gray-500 text-center">Refers solely to validated ledger inputs.</div>
                </div>
            </div>

            {{-- Billing Table --}}
            <div class="bg-[#111c2a] border border-slate-800 rounded-2xl shadow-lg overflow-hidden mb-8">
                <div
                    class="p-4 bg-slate-900/60 border-b border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="font-bold text-base text-white">Institutional Billing History</h3>
                    <div class="flex items-center gap-2">
                        <input type="text" id="billingSearchInput" placeholder="Search Voucher / Roll No..."
                            class="bg-[#090d16] border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-blue-500 transition w-48 placeholder-gray-600">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-slate-900/40 border-b border-slate-800">
                                <th class="p-4">Voucher ID</th>
                                <th class="p-4">Student & Roll Context</th>
                                <th class="p-4">Fee Breakdown Heading</th>
                                <th class="p-4">Payment Method</th>
                                <th class="p-4">Amount Paid</th>
                                <th class="p-4">Clearing Status</th>
                            </tr>
                        </thead>
                        <tbody id="billingLogTableBody" class="text-sm text-gray-300 divide-y divide-slate-800">
                            @include('admin.billing-rows')
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    {{-- Manual Collection Modal --}}
    <div id="collectionModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#090d16] bg-opacity-80 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true" onclick="toggleModal('collectionModal')">
        <div class="w-full max-w-[500px] bg-[#111c2a] rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out"
            onclick="event.stopPropagation()">
            <div class="p-5 flex justify-between items-center border-b border-slate-800/60 bg-[#142032]">
                <h3 class="text-base font-bold flex items-center gap-2.5 text-white">
                    <i class="bi bi-wallet2 text-blue-400 text-lg"></i> Manual Collection Entry
                </h3>
                <button onclick="toggleModal('collectionModal')" class="text-gray-400 hover:text-white transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form action="{{ route('admin.billing.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Student Roll Number</label>
                        <input type="text" name="roll_number" placeholder="e.g. AGI-2026-089" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Student Name</label>
                        <input type="text" name="student_name" placeholder="e.g. Ali Ahmed" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-400">Fee Category / Description</label>
                    <select name="category" required
                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                        <option value="Tuition Fee">Tuition Fee</option>
                        <option value="Exam Fee">Exam Fee</option>
                        <option value="Admission Fee">Admission Charges</option>
                        <option value="Sports / Lab">Lab & Sports Equipment Charges</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Payment Channel</label>
                        <select name="channel" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="Bank Deposit (HBL)">Bank Challan Deposit</option>
                            <option value="Cash Counter">On-Counter Cash</option>
                            <option value="Pay Order">Pay Order / Check</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Amount (PKR)</label>
                        <input type="number" name="amount" placeholder="e.g. 25000" required min="1"
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-400">Clearing Status</label>
                        <select name="status" required
                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/80 transition">
                            <option value="cleared">Cleared</option>
                            <option value="pending">Pending Review</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-slate-800/40">
                    <button type="button" onclick="toggleModal('collectionModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-800 bg-[#172232] text-gray-300 hover:bg-slate-800 hover:text-white transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Record Deposit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            const container = modal.querySelector('.transform');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    if (container) {
                        container.classList.remove('opacity-0', 'scale-95', 'translate-y-4');
                        container.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                    }
                }, 20);
            } else {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                if (container) {
                    container.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                    container.classList.add('opacity-0', 'scale-95', 'translate-y-4');
                }
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 200);
            }
        }



        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
        let searchDebounce;
        document.getElementById('billingSearchInput').addEventListener('input', function() {
            clearTimeout(searchDebounce);
            const query = this.value;

            searchDebounce = setTimeout(() => {
                fetch(`{{ route('admin.billing.search') }}?search=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('billingLogTableBody').innerHTML = data.html;
                    })
                    .catch(err => console.error(err));
            }, 300); // waits 300ms after typing stops before searching
        });
    </script>
</x-layout>
