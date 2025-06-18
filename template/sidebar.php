  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=dashboard">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Koperasi App</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="?page=dashboard">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Data
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-cog"></i>
              <span>Master Data</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Pilih Data:</h6>
                  <a class="collapse-item" href="?page=anggota">Anggota</a>
                  <a class="collapse-item" href="?page=pengguna">Pengguna</a>
              </div>
          </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
              aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Kas</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Pilih Menu:</h6>
                  <a class="collapse-item" href="?page=pemasukan">Pemasukan</a>
                  <a class="collapse-item" href="?page=pengeluaran">Pengeluaran</a>
              </div>
          </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Transaksi
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
              aria-controls="collapsePages">
              <i class="fas fa-fw fa-folder"></i>
              <span>Simpanan</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Pilih Menu:</h6>
                  <a class="collapse-item" href="?page=simpanan">Simpanan Anggota</a>
                  <a class="collapse-item" href="?page=penarikan">Penarikan Simpanan</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#menupeminjaman" aria-expanded="true"
              aria-controls="menupeminjaman">
              <i class="fas fa-fw fa-folder"></i>
              <span>Peminjaman</span>
          </a>
          <div id="menupeminjaman" class="collapse" aria-labelledby="headingPages"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Pilih Menu:</h6>
                  <a class="collapse-item" href="?page=peminjamancreate">Ajukan Peminjaman</a>
                  <a class="collapse-item" href="?page=peminjaman">Data Peminjaman</a>
                  <a class="collapse-item" href="?page=pembayaran">Pembayaran Angsuran</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
              aria-controls="laporan">
              <i class="fas fa-fw fa-folder"></i>
              <span>Laporan</span>
          </a>
          <div id="laporan" class="collapse" aria-labelledby="headingPages"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Pilih Menu:</h6>
                  <a class="collapse-item" href="?page=laporananggota">Laporan Anggota</a>
                  <a class="collapse-item" href="?page=laporanpemasukan">Laporan Pemasukan</a>
                  <a class="collapse-item" href="?page=laporanpengeluaran">Laporan Pengeluaran</a>
                  <a class="collapse-item" href="?page=laporansimpanan">Laporan Simpanan</a>
                  <a class="collapse-item" href="?page=laporanpenarikan">Laporan Penarikan Simpanan</a>
                  <a class="collapse-item" href="?page=laporanpeminjaman">Laporan Peminjaman</a>
                  <a class="collapse-item" href="?page=laporanangsuran">Laporan Angsuran</a>
              </div>
          </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
  <!-- End of Sidebar -->