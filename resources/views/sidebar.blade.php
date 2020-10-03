<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="@yield('indexactive') nav-item"><a href="/"><i class="fa fa-home"></i><span class="menu-title">Dashboard</span></a></li>
        <li class=" nav-item"><a href="#"><i class="fa fa-database"></i><span class="menu-title">Portal</span></a>
            <ul class="menu-content">
                <li class="@yield('pesertaactive')"><a href="{{ route('mata-kuliah') }}"><i></i><span class="menu-item">Data Peserta</span></a></li>
                <li class="@yield('mata-kuliahactive')"><a href="{{ route('mata-kuliah') }}"><i></i><span class="menu-item">Data Mata Kuliah</span></a></li>
                <li class="@yield('tanggunganactive')"><a href="/tanggungan"><i></i><span class="menu-item">Data Jenis Ujian</span></a></li>
                <li class="@yield('riwayatactive')"><a href="#"><i></i><span class="menu-item">Data Jurusan</span></a></li>
                <li class="@yield('riwayatactive')"><a href="#"><i></i><span class="menu-item">Data Kelas</span></a></li>
            </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="fa fa-graduation-cap"></i><span class="menu-title">Ujian</span></a>
            <ul class="menu-content">
                <li class="@yield('tambahactive')"><a href="#"><i></i><span class="menu-item">Tambah Usulan</span></a></li>
                <li class="@yield('tanggunganactive')"><a href="/tanggungan"><i></i><span class="menu-item">Tanggungan</span></a></li>
                <li class="@yield('riwayatactive')"><a href="#"><i></i><span class="menu-item">Riwayat Usulan</span></a></li>
            </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="fa fa-print"></i><span class="menu-title">Cetak</span></a>
            <ul class="menu-content">
                <li class="@yield('tambahactive')"><a href="#"><i></i><span class="menu-item">Tambah Usulan</span></a></li>
                <li class="@yield('tanggunganactive')"><a href="/tanggungan"><i></i><span class="menu-item">Tanggungan</span></a></li>
                <li class="@yield('riwayatactive')"><a href="#"><i></i><span class="menu-item">Riwayat Usulan</span></a></li>
            </ul>
        </li>
        <li class="@yield('pelaksanaanactive') nav-item"><a href="#"><i class="fa fa-cog"></i><span class="menu-title">Pengaturan</span></a></li>
    </ul>
</div>