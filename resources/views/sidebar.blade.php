<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>
        <li class="nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title">Mahasiswa</span></a></li>
        <li class="nav-item"><a href="#"><i class="feather icon-file-text"></i><span class="menu-title">Soal</span></a></li>
        <li class="nav-item"><a href="#"><i class="feather icon-printer"></i><span class="menu-title">Cetak Hasil</span></a></li>
    </ul>
    {{-- <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item"><a href="{{ route('admin.index') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>
        <li class="nav-item"><a href="#"><i class="feather icon-codepen"></i><span class="menu-title">Portal</span></a>
            <ul class="menu-content">
                <li class="{{ (request()->is('admin/portal/mahasiswa*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.mahasiswa.index') }}"><i></i><span class="menu-item">Data Mahasiswa</span></a></li>
                <li class="{{ (request()->is('admin/portal/dosen*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.dosen.index') }}"><i></i><span class="menu-item">Data Dosen</span></a></li>
                <li class="{{ (request()->is('admin/master/mata-kuliah*')) ? 'active' : '' }}"><a href="{{ route('admin.portal.mata-kuliah') }}"><i></i><span class="menu-item">Data Mata Kuliah</span></a></li>
                <li class=""><a href="#"><i></i><span class="menu-item">Data Jenis Ujian</span></a></li>
                <li class=""><a href="#"><i></i><span class="menu-item">Data Jurusan</span></a></li>
                <li class=""><a href="#"><i></i><span class="menu-item">Data Mahasiswa</span></a></li>
                <li class=""><a href="#"><i></i><span class="menu-item">Data Dosen</span></a></li>
                <li class=""><a href="#"><i></i><span class="menu-item">Data Kelas</span></a></li>
            </ul>
        </li>
    </ul> --}}
</div>