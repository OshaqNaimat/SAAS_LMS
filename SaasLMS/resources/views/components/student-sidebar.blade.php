 <aside class="sidebar" id="sidebar">
     <div class="sidebar-brand">
         <div class="brand-icon text-blue-400"><i class="bi bi-mortarboard-fill"></i></div>
         <div class="brand-text">
             <span class="org-name">Apex College</span>
             <span
                 class="org-plan border border-blue-500/30 text-blue-400 bg-blue-500/5 px-1.5 py-0.5 rounded text-[10px]">Student
                 Portal</span>
         </div>
     </div>

     <div class="sidebar-section">
         <div class="sidebar-label">Navigation</div>
         <a href="/student-dashboard" class="nav-item active">
             <i class="bi bi-grid-1x2-fill"></i> My Dashboard
         </a>
         <a href="/student-timetable" class="nav-item">
             <i class="bi bi-calendar3"></i> Class Timetable
         </a>
         <a href="/student-attendance" class="nav-item">
             <i class="bi bi-person-check-fill"></i> My Attendance
         </a>
     </div>

     <div class="sidebar-spacer"></div>

     <div class="sidebar-footer">
         <div
             class="user-card border border-slate-800/60 bg-slate-900/40 p-3 rounded-xl flex items-center justify-between gap-3">
             <div class="flex items-center gap-2.5 min-w-0">
                 @php
                     // Fetch the currently authenticated student's details
$studentName = Auth::user()->name ?? 'Student';
$rollNumber = Auth::user()->roll_number ?? 'N/A';

// Split the name by spaces to extract initials
$words = explode(' ', $studentName);

// Grab the first letter of the first word, and the first letter of the second word
$initials = strtoupper(
    substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''),
                     );
                 @endphp

                 <div
                     class="user-avatar w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-xs shrink-0">
                     {{ $initials }}
                 </div>
                 <div class="user-info truncate">
                     <strong class="block text-xs font-semibold text-white truncate">{{ $studentName }}</strong>
                     <small class="block text-[10px] text-gray-400 truncate">Roll No: {{ $rollNumber }}</small>
                 </div>
             </div>
             <form action="/logout" method="POST" class="m-0 flex items-center">
                 @csrf
                 <button type="submit" class="logout-btn p-1.5 text-gray-500 hover:text-rose-400 rounded-lg transition"
                     title="Sign Out">
                     <i class="bi bi-box-arrow-right text-sm"></i>
                 </button>
             </form>
         </div>

     </div>
 </aside>
