@if (auth()->user()->type == 'admin')
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/barang" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Barang
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="/pelanggan" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                    Pelanggan
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="/penjualan" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                    Penjualan
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="/pembelian" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                    Pembelian
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/supplier" class="nav-link">
                <i class="nav-icon fas fa-suitcase"></i>
                <p>
                    Supplier
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/kategori" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/laporan" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Laporan
                </p>
            </a>
        </li>
    </ul>
</nav>
@endif
@if (auth()->user()->type == 'kasir')
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
            <a href="/penjualan" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                    Penjualan
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="/pembelian" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                    Pembelian
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/laporan" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Laporan
                </p>
            </a>
        </li>
    </ul>
</nav>
@endif