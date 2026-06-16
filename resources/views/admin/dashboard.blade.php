@extends('admin.layouts.app')

@section('content')

<style>
.dashboard-card {
    border: none;
    border-radius: 14px;
    color: #fff;
    transition: all 0.3s ease;
    overflow: hidden;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.card-icon {
    font-size: 40px;
    opacity: 0.25;
}
.gradient-blue {
    background: linear-gradient(135deg, #4e73df, #224abe);
}
.gradient-green {
    background: linear-gradient(135deg, #1cc88a, #169b6b);
}
.gradient-orange {
    background: linear-gradient(135deg, #f6c23e, #dda20a);
}
.stat-title {
    font-size: 14px;
    letter-spacing: 0.5px;
    opacity: 0.9;
}
.stat-value {
    font-size: 28px;
    font-weight: 700;
}
</style>
<style>
.dashboard-card {
    border: none;
    border-radius: 16px;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.15);
}

/* New Premium Gradients */
.gradient-purple {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.gradient-teal {
    background: linear-gradient(135deg, #0ba360, #3cba92);
}

.gradient-pink {
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
}

.gradient-darkblue {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
}

.stat-title {
    font-size: 14px;
    opacity: 0.9;
    letter-spacing: 0.4px;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
}

.card-icon {
    font-size: 42px;
    opacity: 0.25;
}
</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Dashboard</h3>
        <span class="text-muted">Welcome back, Admin 👋</span>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">

        <!-- Total Gallery -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-blue p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Vendors</div>
                        <div class="stat-value">{{ $vendors }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-images"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Images (Optional if relation exists) -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-green p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value">{{ $users }}
                          
                        </div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-image"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Galleries -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-orange p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Active Products</div>
                        <div class="stat-value">
                           {{ $products }}
                        </div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive Galleries -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card bg-dark p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Active Services</div>
                        <div class="stat-value">
                           {{ $services }}
                        </div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Blog Stats Cards -->
    <div class="row g-4 mt-2">

        <!-- Total Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-purple p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Properties</div>
                        <div class="stat-value">{{ $properties }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Published Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-teal p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Categorys</div>
                        <div class="stat-value">{{ $category }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive / Draft Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-pink p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Sub Categorys</div>
                        <div class="stat-value">{{ $category }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-pen-to-square"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card gradient-darkblue p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Vendor Types</div>
                        <div class="stat-value">
                            {{ $vendortypes }}
                        </div>
                    </div>
                    <div class="card-icon">
                        <i class="fa fa-calendar-days"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Section (Optional Enhancement) -->
   

</div>

@endsection