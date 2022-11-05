<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-coffee"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Milkteashop</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Product Components:</h6>
                <a class="collapse-item" href="{{ url('/admin/product-list') }}">Products List</a>
            </div>
        </div>
    </li>

    <!-- Orders -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order" aria-expanded="true"
            aria-controls="order">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
        <div id="order" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Order Components:</h6>
                <a class="collapse-item" href="{{ url('/admin/orders-list') }}">Orders List</a>
            </div>
        </div>
    </li>

    <!-- Inventory -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AddOns" aria-expanded="true"
            aria-controls="AddOns">
            <i class="fas fa-fw fa-plus"></i>
            <span>Inventory</span>
        </a>
        <div id="AddOns" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Regular</h6>
                <a class="collapse-item" href="{{ route('regulars.index') }}">Add-ons</a>
                <a class="collapse-item" href="{{ url('/admin/bottle-size') }}">Bottle Size</a>
                <hr>
                <h6 class="collapse-header">Premium</h6>
                <a class="collapse-item" href="{{ route('premiums.index') }}">Add-ons</a>
                <a class="collapse-item" href="{{ route('premium_sizes.index') }}">Bottle Size</a>
                <hr>
                <h6 class="collapse-header">Shipping</h6>
                <a class="collapse-item" href="{{ url('/admin/shipping-fee') }}">User Shipping Fee</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">


</ul>