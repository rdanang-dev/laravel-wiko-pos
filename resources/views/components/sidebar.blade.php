<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Wisata Kopi</h3>
        <h3 class="small">Points Of Sales</h3>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="/"><i class="mdi mdi-view-dashboard mr-2"></i>Dashboard</a>
        </li>
        <li>
            <a href="{{ route('transactions.transaction') }}"><i class="mdi mdi-cart-outline mr-2"></i>Transaksi</a>
        </li>
        <li>
            <a href="#"><i class="mdi mdi-cart-arrow-down mr-2"></i>Cart</a>
        </li>
        <li>
            <a href="#"><i class="mdi mdi-clipboard-outline mr-2"></i>Kelola Menu</a>
        </li>
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="mdi mdi-account-box mr-2"></i>Kelola Akun</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Daftar Akun</a>
                </li>
                <li>
                    <a href="#">Hak Akses</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="mdi mdi-file-edit-outline mr-2"></i>Kelola
                Laporan</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Laporan Transaksi</a>
                </li>
                <li>
                    <a href="#">Laporan Pegawai</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
