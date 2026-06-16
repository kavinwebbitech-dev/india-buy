{{-- resources/views/admin/products/show.blade.php --}}

@extends('admin.layouts.app')

@section('page-title', 'Product Details')

@section('content')

<style>

    .product-image{
        width:100%;
        height:180px;
        object-fit:cover;
        border-radius:12px;
        border:1px solid #ddd;
    }

    .company-logo{
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:16px;
        border:1px solid #ddd;
    }

    .info-title{
        font-size:13px;
        color:#6b7280;
        margin-bottom:5px;
    }

    .info-value{
        font-size:15px;
        font-weight:600;
        color:#111827;
    }

    .company-box{
        background:#f8fafc;
        border:1px solid #e5e7eb;
        border-radius:16px;
        padding:20px;
    }

</style>

<div class="main">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-4">

        <ol class="breadcrumb">

            <li class="breadcrumb-item">

                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>

            </li>

            <li class="breadcrumb-item">

                <a href="{{ route('admin.products.index') }}">
                    Products
                </a>

            </li>

            <li class="breadcrumb-item active">

                Product Details

            </li>

        </ol>

    </nav>

    <div class="card-custom p-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4>
                Product Details
            </h4>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        {{-- COMPANY DETAILS --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Company Details
                </h5>

                <div class="company-box">

                    <div class="row align-items-center">

                        {{-- LOGO --}}
                        <div class="col-md-2 text-center mb-3 mb-md-0">

                            @if($product->vendor && $product->vendor->company_logo)

                                <img src="{{ asset('uploads/vendor_logo/'.$product->vendor->company_logo) }}"
                                     class="company-logo">

                            @else

                                <img src="{{ asset('admin/no-image.png') }}"
                                     class="company-logo">

                            @endif

                        </div>

                        {{-- DETAILS --}}
                        <div class="col-md-10">

                            <div class="row g-4">

                                {{-- COMPANY NAME --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Company Name
                                    </div>

                                    <div class="info-value">
                                        {{ $product->vendor->company_name ?? '-' }}
                                    </div>

                                </div>

                                {{-- EMAIL --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Company Email
                                    </div>

                                    <div class="info-value">
                                        {{ $product->vendor->email ?? '-' }}
                                    </div>

                                </div>

                                {{-- PHONE --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Phone Number
                                    </div>

                                    <div class="info-value">
                                        {{ $product->vendor->phone ?? '-' }}
                                    </div>

                                </div>

                                {{-- GST --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        GST Number
                                    </div>

                                    <div class="info-value">
                                        {{ $product->vendor->gst_no ?? '-' }}
                                    </div>

                                </div>

                                {{-- LOCATION --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Location
                                    </div>

                                    <div class="info-value">

                                        {{ $product->vendor->city ?? '' }}

                                        {{ $product->vendor->state ?? '' }}

                                        {{ $product->vendor->country ?? '' }}

                                    </div>

                                </div>

                                {{-- ESTABLISHED --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Year Established
                                    </div>

                                    <div class="info-value">
                                        {{ $product->vendor->year_established ?? '-' }}
                                    </div>

                                </div>

                                {{-- ABOUT --}}
                                <div class="col-md-12">

                                    <div class="info-title">
                                        About Company
                                    </div>

                                    <div class="info-value">
                                        {!! nl2br(e($product->vendor->about_us ?? '-')) !!}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            {{-- IMAGES --}}
            <div class="col-md-4">

                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="mb-3">
                            Product Images
                        </h5>

                        @php
                            $images = json_decode($product->image, true);
                        @endphp

                        <div class="row">

                            @if(!empty($images))

                                @foreach($images as $img)

                                    <div class="col-6 mb-3">

                                        <img src="{{ asset('uploads/products/'.$img) }}"
                                             class="product-image">

                                    </div>

                                @endforeach

                            @else

                                <div class="col-12">

                                    <img src="{{ asset('admin/no-image.png') }}"
                                         class="product-image">

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            {{-- DETAILS --}}
            <div class="col-md-8">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="row g-4">

                            {{-- PRODUCT NAME --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Product Name
                                </div>

                                <div class="info-value">
                                    {{ $product->product_name }}
                                </div>

                            </div>

                            {{-- BRAND --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Brand
                                </div>

                                <div class="info-value">
                                    {{ $product->brand ?? '-' }}
                                </div>

                            </div>

                            {{-- MODEL --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Model Number
                                </div>

                                <div class="info-value">
                                    {{ $product->model_number ?? '-' }}
                                </div>

                            </div>

                            {{-- CATEGORY --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Category
                                </div>

                                <div class="info-value">
                                    {{ $product->categoryData->category_name ?? '-' }}
                                </div>

                            </div>

                            {{-- SUB CATEGORY --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Sub Category
                                </div>

                                <div class="info-value">
                                    {{ $product->subCategoryData->sub_category_name ?? '-' }}
                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Status
                                </div>

                                <div>

                                    @if($product->status == 1)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </div>

                            </div>

                            {{-- SHORT DESCRIPTION --}}
                            <div class="col-md-12">

                                <div class="info-title">
                                    Short Description
                                </div>

                                <div class="info-value">
                                    {{ $product->short_description ?? '-' }}
                                </div>

                            </div>

                            {{-- PRODUCT DETAILS --}}
                            <div class="col-md-12">

                                <div class="info-title">
                                    Product Details
                                </div>

                                <div class="info-value">
                                    {!! nl2br(e($product->product_details)) !!}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- KEY VALUES --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Key Values
                </h5>

                @php
                    $keyValues = json_decode($product->key_value, true);
                @endphp

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th width="40%">
                                    Key
                                </th>

                                <th>
                                    Value
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @if(!empty($keyValues))

                                @foreach($keyValues as $item)

                                    <tr>

                                        <td>
                                            {{ $item['key'] ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item['value'] ?? '-' }}
                                        </td>

                                    </tr>

                                @endforeach

                            @else

                                <tr>

                                    <td colspan="2" class="text-center">
                                        No Data
                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- SPECIFICATIONS --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Specifications
                </h5>

                @php
                    $specifications = json_decode($product->specification, true);
                @endphp

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th width="40%">
                                    Specification
                                </th>

                                <th>
                                    Value
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @if(!empty($specifications))

                                @foreach($specifications as $item)

                                    <tr>

                                        <td>
                                            {{ $item['name'] ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item['value'] ?? '-' }}
                                        </td>

                                    </tr>

                                @endforeach

                            @else

                                <tr>

                                    <td colspan="2" class="text-center">
                                        No Data
                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- DATASHEET --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Datasheet
                </h5>

                @php
                    $datasheets = json_decode($product->data_sheet, true);
                @endphp

                @if(!empty($datasheets))

                    @foreach($datasheets as $sheet)

                        <a href="{{ asset('uploads/datasheets/'.$sheet) }}"
                           target="_blank"
                           class="btn btn-primary btn-sm mb-2">

                            View Datasheet

                        </a>

                    @endforeach

                @else

                    <p>
                        No Datasheet Uploaded
                    </p>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection