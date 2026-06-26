<div class="sidebar">
    <style>
        .sidebar {
            position: fixed;
            /* if using fixed sidebar */
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            /* enables vertical scroll */
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 6px;
        }
    </style>

    <h4 class="text-center py-4 border-bottom">
        India Buy
        <!-- <img src="{{ asset('asset/frontend/new/logo.svg') }}"
             alt="Sherene"
             class="img-fluid"
             style="max-height: 60px;"> -->
    </h4>


    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        <i class="fa fa-gauge-high me-2"></i> Dashboard

    </a>


    <a href="{{ route('admin.vendortype.index') }}"
        class="nav-link {{ request()->routeIs('admin.vendortype.*') ? 'active' : '' }}">

        <i class="fa fa-id-badge me-2"></i> Vendor Type

    </a>


    <a href="{{ route('admin.businesstype.index') }}"
        class="nav-link {{ request()->routeIs('admin.businesstype.*') ? 'active' : '' }}">

        <i class="fa fa-briefcase me-2"></i> Business Type

    </a>


    <a href="{{ route('admin.category.index') }}"
        class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">

        <i class="fa fa-layer-group me-2"></i> Category

    </a>


    <a href="{{ route('admin.subcategory.index') }}"
        class="nav-link {{ request()->routeIs('admin.subcategory.*') ? 'active' : '' }}">

        <i class="fa fa-sitemap me-2"></i> Subcategory

    </a>


    <a href="{{ route('admin.users.index') }}"
        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

        <i class="fa fa-users me-2"></i> Users

    </a>


    <a href="{{ route('admin.vendors.index') }}"
        class="nav-link {{ request()->routeIs('admin.vendors.*') ? 'active' : '' }}">

        <i class="fa fa-store me-2"></i> Vendors

    </a>


    <a href="{{ route('admin.products.index') }}"
        class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

        <i class="fa fa-box-open me-2"></i> Products

    </a>


    <a href="{{ route('admin.services.index') }}"
        class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">

        <i class="fa fa-gears me-2"></i> Services
    </a>


    <a href="{{ route('admin.properties.index') }}"
        class="nav-link {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">

        <i class="fa fa-city me-2"></i> Properties

    </a>
    <a href="{{ route('admin.bannerplans.index') }}"
        class="nav-link {{ request()->routeIs('admin.bannerplans.*') ? 'active' : '' }}">

        <i class="fa fa-city me-2"></i> Banner Plans

    </a>

    <div class="mt-auto p-3">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-light w-100">
                <i class="fa fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>

</div>
