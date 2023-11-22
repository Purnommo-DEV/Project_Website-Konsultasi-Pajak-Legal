 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
         <div class="sidebar-header">
             <div class="d-flex justify-content-between">
                 <div class="logo">
                     <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                 </div>
                 <div class="toggler">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">
                 <li class="sidebar-item {{ request()->routeIs('admin.HalamanDashboard*') ? 'active' : '' }}">
                     <a href="{{ route('admin.HalamanDashboard') }}" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ request()->routeIs('admin.DataMaster*') ? 'active' : '' }} has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-stack"></i>
                         <span>Master</span>
                     </a>
                     <ul class="submenu {{ request()->routeIs('admin.DataMaster*') ? 'active' : '' }}">
                         <li
                             class="submenu-item {{ request()->routeIs('admin.DataMaster.PaketPajak') ? 'active' : '' }}">
                             <a href="{{ route('admin.DataMaster.PaketPajak') }}">Paket Pajak</a>
                         </li>
                         <li
                             class="submenu-item {{ request()->routeIs('admin.DataMaster.PaketBundlingPajak') ? 'active' : '' }}">
                             <a href="{{ route('admin.DataMaster.PaketBundlingPajak') }}">Paket Bundling Pajak</a>
                         </li>
                         <li
                             class="submenu-item {{ request()->routeIs('admin.DataMaster.PaketPelayananNotaris') ? 'active' : '' }}">
                             <a href="{{ route('admin.DataMaster.PaketPelayananNotaris') }}">Paket Pelayanan Notaris</a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item {{ request()->routeIs('LogoutPengguna*') ? 'active' : '' }}">
                     <a href="{{ route('LogoutPengguna') }}" class='sidebar-link'>
                         <i class="bi bi-arrow-left-short"></i>
                         <span>Keluar</span>
                     </a>
                 </li>
             </ul>
         </div>

         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>
