<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <div class="logo-container">
                <a href="index.html">
                    <a href="#" class="logo-text">MEUBEL 2N</a>
                    <img src="{{ asset('img/logo2.png') }}" alt="logo" width="100">
                </a>
            </div>

            <style>
                /* Add some space below the logo */
                .sidebar-brand {
                    margin-bottom: 20px;
                    /* Adjust this value as needed */
                }

                /* Adjust the Dashboard section */
                .sidebar-menu .menu-header {
                    margin-top: 20px;
                    /* Adjust this value to create space before the dashboard menu */
                }

                /* Optionally, adjust padding or margin for the nav items */
                .sidebar-menu li {
                    padding-top: 10px;
                    /* Adjust spacing between menu items */
                }
            </style>


        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('home*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i
                        class="fas fa-chart-line"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Users</li>
            <li class="{{ Request::is('user*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i><span>All
                        Users</span></a>
            </li>

            <li class="menu-header">Product</li>
            <li class="{{ Request::is('product*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.index') }}"><i class="fas fa-box"></i><span>All
                        Products</span></a>

            </li>
            <li class="menu-header">Orders</li>
            <li class="{{ Request::is('order*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('order.index') }}"><i class="fas fa-shopping-cart"></i><span>All
                        Orders
                    </span></a>
            </li>


    </aside>
</div>
