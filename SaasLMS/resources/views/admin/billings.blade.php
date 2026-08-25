<x-layout>
    <div class="flex h-screen overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 min-h-0 overflow-y-auto p-6 lg:p-8 bg-gray-50">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Billing & Fee Management</h1>
                    <p class="text-sm text-gray-500 mt-1">Track manual fee collections, verify ledger entries, and audit
                        systemic accounts.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0 sm:self-center">
                    <button onclick="toggleModal('collectionModal')"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                        <i class="bi bi-plus-lg"></i> Record Payment
                    </button>
                    <button onclick="toggleSidebar()" class="hamburger-btn lg:hidden" aria-label="Open menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- ─── KPI CARDS ─── -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Total Collected (Term)</span>
                        <h4 class="text-2xl font-bold text-gray-900 tracking-tight">PKR
                            {{ number_format($totalCollected) }}</h4>
                        <span class="text-[11px] text-emerald-600 flex items-center gap-1"><i
                                class="bi bi-arrow-up-short"></i> {{ $collectedPct }}% of total invoices</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-600 text-xl">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Outstanding Receivables</span>
                        <h4 class="text-2xl font-bold text-amber-600 tracking-tight">PKR
                            {{ number_format($outstanding) }}</h4>
                        <span class="text-[11px] text-amber-600 flex items-center gap-1"><i class="bi bi-clock"></i>
                            {{ $pendingCount }} Pending invoices</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-amber-600 text-xl">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Overdue Accounts</span>
                        <h4 class="text-2xl font-bold text-red-500 tracking-tight">{{ $overdueCount }} Cases</h4>
                        <span class="text-[11px] text-red-500 flex items-center gap-1">Grace periods expired</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-red-100 border border-red-200 flex items-center justify-center text-red-500 text-xl">
                        <i class="bi bi-exclamation-octagon"></i>
                    </div>
                </div>
                <div
                    class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-gray-500 font-medium">Bank Transfer Cleared</span>
                        <h4 class="text-2xl font-bold text-blue-600 tracking-tight">{{ $bankPct }}%</h4>
                        <span class="text-[11px] text-gray-500">vs {{ $cashPct }}% Direct Cash</span>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-blue-600 text-xl">
                        <i class="bi bi-bank"></i>
                    </div>
                </div>
            </div>

            <!-- ─── CHARTS ─── -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 flex flex-col justify-between shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Collections by Fee Category</h3>
                            <p class="text-xs text-gray-500">Analysis of capital weightings across systemic items</p>
                        </div>
                        <span
                            class="text-[10px] uppercase font-bold text-blue-600 bg-blue-100 border border-blue-200 px-2.5 py-1 rounded-md">Q2
                            Baseline</span>
                    </div>

                    <div class="flex items-end justify-between h-44 pt-4 px-4 border-b border-gray-200 gap-6">
                        @foreach ($categoryTotals as $cat => $pct)
                            <div class="w-1/4 flex flex-col items-center gap-2 h-full justify-end group">
                                <div class="w-full max-w-[48px] {{ $cat === 'Sports / Lab' ? 'bg-amber-500/60 group-hover:bg-amber-500' : 'bg-blue-500/60 group-hover:bg-blue-500' }} rounded-t-md transition-all"
                                    style="height: {{ $pct }}%"></div>
                                <span
                                    class="text-[11px] {{ $cat === 'Sports / Lab' ? 'text-amber-600' : 'text-gray-500' }}">{{ $cat }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col justify-between shadow-sm">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 mb-1">Collection Channels</h3>
                        <p class="text-xs text-gray-500">Breakdown of clearing methods chosen by targets</p>
                    </div>
                    <div class="space-y-4 py-2">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Bank Deposit Challan</span>
                                <span
                                    class="text-gray-800 font-medium">{{ $channelTotals['Bank Deposit (HBL)'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-blue-500 h-full"
                                    style="width: {{ $channelTotals['Bank Deposit (HBL)'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Direct Over-Counter Cash</span>
                                <span class="text-gray-800 font-medium">{{ $channelTotals['Cash Counter'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full"
                                    style="width: {{ $channelTotals['Cash Counter'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Pay Order / Check Drop</span>
                                <span class="text-gray-800 font-medium">{{ $channelTotals['Pay Order'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full" style="width: {{ $channelTotals['Pay Order'] }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-[11px] text-gray-400 text-center">Refers solely to validated ledger inputs.</div>
                </div>
            </div>

            <!-- ─── BILLING TABLE ─── -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div
                    class="p-4 bg-gray-50 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="font-bold text-base text-gray-800">Institutional Billing History</h3>
                    <div class="flex items-center gap-2">
                        <input type="text" id="billingSearchInput" placeholder="Search Student name..."
                            class="bg-white border border-gray-300 rounded-xl px-3 py-1.5 text-xs text-gray-800 focus:outline-none focus:border-blue-500 transition w-48 placeholder-gray-400">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50/80 border-b border-gray-200">
                                <th class="p-4">Voucher ID</th>
                                <th class="p-4">Student & Roll Context</th>
                                <th class="p-4">Fee Breakdown Heading</th>
                                <th class="p-4">Payment Method</th>
                                <th class="p-4">Amount Paid</th>
                                <th class="p-4">Clearing Status</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="billingLogTableBody" class="text-sm text-gray-600 divide-y divide-gray-100">
                            @include('admin.billing-rows')
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- ─── COLLECTION MODAL ─── -->
    <div id="collectionModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true" onclick="toggleModal('collectionModal')">
        <div class="w-full max-w-[500px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out"
            onclick="event.stopPropagation()">
            <div class="p-5 flex justify-between items-center border-b border-gray-200 bg-gray-50">
                <h3 class="text-base font-bold flex items-center gap-2.5 text-gray-800">
                    <i class="bi bi-wallet2 text-blue-600 text-lg"></i> Manual Collection Entry
                </h3>
                <button onclick="toggleModal('collectionModal')" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form action="{{ route('admin.billing.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Student Roll Number</label>
                        <input type="text" name="roll_number" placeholder="e.g. AGI-2026-089" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Student Name</label>
                        <input type="text" name="student_name" placeholder="e.g. Ali Ahmed" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-500">Fee Category / Description</label>
                    <select name="category" required
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
                        <option value="Tuition Fee">Tuition Fee</option>
                        <option value="Exam Fee">Exam Fee</option>
                        <option value="Admission Fee">Admission Charges</option>
                        <option value="Sports / Lab">Lab & Sports Equipment Charges</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Payment Channel</label>
                        <select name="channel" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
                            <option value="Bank Deposit (HBL)">Bank Challan Deposit</option>
                            <option value="Cash Counter">On-Counter Cash</option>
                            <option value="Pay Order">Pay Order / Check</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Amount (PKR)</label>
                        <input type="number" name="amount" placeholder="e.g. 25000" required min="1"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-gray-500">Clearing Status</label>
                        <select name="status" required
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
                            <option value="cleared">Cleared</option>
                            <option value="pending">Pending Review</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 flex justify-end gap-3 border-t border-gray-200">
                    <button type="button" onclick="toggleModal('collectionModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-gray-300 bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Record Deposit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ─── EDIT STATUS MODAL ─── -->
    <div id="editStatusModal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 hidden opacity-0 transition-opacity duration-200 ease-out"
        role="dialog" aria-modal="true" onclick="toggleModal('editStatusModal')">
        <div class="w-full max-w-[400px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden transform opacity-0 scale-95 translate-y-4 transition-all duration-200 ease-out"
            onclick="event.stopPropagation()">
            <div class="p-5 flex justify-between items-center border-b border-gray-200 bg-gray-50">
                <h3 class="text-base font-bold flex items-center gap-2.5 text-gray-800">
                    <i class="bi bi-pencil-square text-yellow-600 text-lg"></i> Update Clearing Status
                </h3>
                <button onclick="toggleModal('editStatusModal')" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>
            <form id="editStatusForm" class="p-6 space-y-4" onsubmit="submitStatusUpdate(event)">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-500">New Status</label>
                    <select id="editStatusSelect"
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
                        <option value="cleared">Cleared</option>
                        <option value="pending">Pending Review</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
                <div class="pt-3 flex justify-end gap-3 border-t border-gray-200">
                    <button type="button" onclick="toggleModal('editStatusModal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold border border-gray-300 bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                        Update Status
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
            }, 300);
        });

        let currentEditPaymentId = null;

        function openEditPayment(id, currentStatus) {
            currentEditPaymentId = id;
            document.getElementById('editStatusSelect').value = currentStatus;
            toggleModal('editStatusModal');
        }

        function submitStatusUpdate(event) {
            event.preventDefault();
            const newStatus = document.getElementById('editStatusSelect').value;

            fetch(`/admin/billing/${currentEditPaymentId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        status: newStatus
                    }),
                })
                .then(res => res.json())
                .then(() => location.reload())
                .catch(err => console.error(err));
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                sidebar.classList.add('open');
                overlay.classList.add('show');
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
    </script>
</x-layout>
