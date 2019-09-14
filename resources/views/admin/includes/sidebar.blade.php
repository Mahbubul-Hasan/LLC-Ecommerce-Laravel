<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route("admin.dashboard") }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route("admin.categories.index") }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Category</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route("admin.products.index") }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Product</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route("admin.orders.index") }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Order</span>
        </a>
    </li>
</ul>