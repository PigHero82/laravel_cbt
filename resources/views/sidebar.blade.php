<div class="main-menu-content">
    <ul class="navigation navigation-main" {{ (request()->is('pengampu*')) ? '' : 'hidden' }} id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item {{ (request()->is('pengampu')) ? 'active' : '' }}"><a href="{{ route('dosen.index') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>
        <li class="nav-item {{ (request()->is('pengampu/mahasiswa*')) ? 'active' : '' }}"><a href="{{ route('dosen.mahasiswa') }}"><i class="feather icon-users"></i><span class="menu-title">Mahasiswa</span></a></li>
        <li class="nav-item {{ (request()->is('pengampu/paket*')) ? 'active' : '' }} {{ (request()->is('pengampu/soal*')) ? 'active' : '' }}"><a href="{{ route('dosen.paket.index') }}"><i class="feather icon-file-text"></i><span class="menu-title">Soal</span></a></li>
        <li class="nav-item {{ (request()->is('pengampu/laporan*')) ? 'active' : '' }}"><a href="{{ route('dosen.laporan.index') }}"><i class="feather icon-printer"></i><span class="menu-title">Laporan</span></a></li>
    </ul>
    <ul class="navigation navigation-main" {{ (request()->is('admin*')) ? '' : 'hidden' }} id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>
        <li class="nav-item"><a href="#"><i class="feather icon-codepen"></i><span class="menu-title">Portal</span></a>
            <ul class="menu-content">
                <li class="{{ (request()->is('admin/portal/user*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.user.index') }}"><i></i><span class="menu-item">Data User</span></a></li>
                <li class="{{ (request()->is('admin/portal/pengampu*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.pengampu.index') }}"><i></i><span class="menu-item">Data Pengampu</span></a></li>
                <li class="{{ (request()->is('admin/portal/mata-kuliah*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.mata-kuliah.index') }}"><i></i><span class="menu-item">Data Mata Kuliah</span></a></li>
                <li class="{{ (request()->is('admin/portal/kelas*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.kelas.index') }}"><i></i><span class="menu-item">Data Kelas</span></a></li>
            </ul>
        </li>
        <li class="nav-item {{ (request()->is('admin/laporan*')) ? 'active' : '' }}"><a href="{{ route('admin.laporan.index') }}"><i class="feather icon-printer"></i><span class="menu-title">Laporan</span></a></li>
        <li class="nav-item {{ (request()->is('admin/pengaturan*')) ? 'active' : '' }}"><a href="{{ route('admin.pengaturan') }}"><i class="feather icon-settings"></i><span class="menu-title">Pengaturan</span></a></li>
    </ul>
</div>