 <aside class="sidebar" id="sidebar">
     <div class="sidebar-brand">
         <div class="brand-icon"><i class="bi bi-shield-lock-fill"></i></div>
         <div>
             <span>NEXUS</span>
             <small>CORE REALM v2.4</small>
         </div>
     </div>

     <div class="sidebar-section">
         <div class="sidebar-label">Overview</div>
         <a class="nav-item {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}"
             href="{{ route('super-admin.dashboard') }}">
             Dashboard
         </a>
         <a class="nav-item {{ request()->routeIs('super-admin-organizations') ? 'active' : '' }}"
             href="{{ route('super-admin.organizations') }}">
             <i class="bi bi-building"></i> Organizations
             <span class="nav-badge">12</span>
         </a>
     </div>

     <div class="sidebar-section">
         <div class="sidebar-label">System</div>

         <a class="nav-item {{ request()->routeIs('super-admin-analytics') ? 'active' : '' }}"
             href="{{ route('super-admin.analytics') }}">
             <i class="bi bi-bar-chart-fill"></i> Analytics
         </a>
         {{-- <a class="nav-item {{ request()->routeIs('super-admin-settings') ? 'active' : '' }}"
             href="{{ route('super-admin.settings') }}">
             <i class="bi bi-gear-fill"></i> Settings
         </a> --}}
         <a class="nav-item" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
     </div>

     <div class="sidebar-footer">
         <div class="admin-card">
             <div class="admin-avatar">SA</div>
             <div class="admin-info">
                 <strong>Super Admin</strong>
                 <small>admin@nexus.io</small>
             </div>
             <i class="bi bi-three-dots-vertical" style="color:var(--text-muted); cursor:pointer;"></i>
         </div>
     </div>
 </aside>
 <script>
     const navItems = document.querySelectorAll('.nav-item');

     navItems.forEach(item => {
         item.addEventListener('click', function() {

             // remove active class from all
             navItems.forEach(nav => nav.classList.remove('active'));

             // add active class to clicked item
             this.classList.add('active');
         });
     });
 </script>

 {{-- <a class="nav-item" href="#"><i class="bi bi-bell-fill"></i> Notifications</a> --}}
 {{-- <a class="nav-item" href="#"><i class="bi bi-shield-check"></i> Security</a> --}}
 {{-- <a class="nav-item" href="#"><i class="bi bi-people-fill"></i> Users</a> --}}
 {{-- <a class="nav-item" href="#"><i class="bi bi-cpu-fill"></i> Nodes</a> --}}
