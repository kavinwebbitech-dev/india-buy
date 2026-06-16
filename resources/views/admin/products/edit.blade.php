{{-- resources/views/admin/products/edit.blade.php --}}

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

    .label-title{
        font-size:13px;
        font-weight:600;
        margin-bottom:6px;
        color:#6b7280;
    }

    .readonly-box{
        width:100%;
        min-height:45px;
        border:1px solid #ddd;
        border-radius:10px;
        padding:10px 14px;
        background:#f8fafc;
        font-size:14px;
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
                Edit Product
            </li>

        </ol>

    </nav>

    {{-- CARD --}}
    <div class="card-custom p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4>
                Product Details
            </h4>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- ALL IMAGES --}}
            <div class="mb-5">

                <h5 class="mb-3">
                    Product Images
                </h5>

                @php
                    $images = json_decode($product->image, true);
                @endphp

                <div class="row">

                    @if(!empty($images))

                        @foreach($images as $img)

                            <div class="col-md-3 mb-3">

                                <img src="{{ asset('uploads/products/'.$img) }}"
                                     class="product-image">

                            </div>

                        @endforeach

                    @else

                        <div class="col-md-3">

                            <img src="{{ asset('admin/no-image.png') }}"
                                 class="product-image">

                        </div>

                    @endif

                </div>

            </div>

            {{-- PRODUCT DETAILS --}}
            <div class="row g-4">

                {{-- PRODUCT NAME --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Product Name
                    </label>

                    <div class="readonly-box">

                        {{ $product->product_name }}

                    </div>

                </div>

                {{-- BRAND --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Brand
                    </label>

                    <div class="readonly-box">

                        {{ $product->brand ?? '-' }}

                    </div>

                </div>

                {{-- MODEL NUMBER --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Model Number
                    </label>

                    <div class="readonly-box">

                        {{ $product->model_number ?? '-' }}

                    </div>

                </div>

                {{-- CATEGORY --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Category
                    </label>

                    <div class="readonly-box">

                        {{ $product->categoryData->category_name ?? '-' }}

                    </div>

                </div>

                {{-- SUB CATEGORY --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Sub Category
                    </label>

                    <div class="readonly-box">

                        {{ $product->subCategoryData->sub_category_name ?? '-' }}

                    </div>

                </div>

                {{-- STATUS --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Status
                    </label>

                    <select name="status"
                            class="form-control">

                        <option value="1"
                            {{ $product->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ $product->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                {{-- SHORT DESCRIPTION --}}
                <div class="col-md-12">

                    <label class="label-title">
                        Short Description
                    </label>

                    <div class="readonly-box">

                        {{ $product->short_description ?? '-' }}

                    </div>

                </div>

                {{-- PRODUCT DETAILS --}}
                <div class="col-md-12">

                    <label class="label-title">
                        Product Details
                    </label>

                    <div class="readonly-box">

                        {!! nl2br(e($product->product_details)) !!}

                    </div>

                </div>

            </div>

            {{-- KEY VALUES --}}
            <div class="mt-5">

                <h5 class="mb-3">
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

                                    <td colspan="2"
                                        class="text-center">

                                        No Data Found

                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- SPECIFICATIONS --}}
            <div class="mt-5">

                <h5 class="mb-3">
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

                                    <td colspan="2"
                                        class="text-center">

                                        No Specifications Found

                                    </td>

                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- DATASHEET --}}
            <div class="mt-5">

                <h5 class="mb-3">
                    Datasheet
                </h5>

                @php
                    $datasheets = json_decode($product->data_sheet, true);
                @endphp

                @if(!empty($datasheets))

                    @foreach($datasheets as $sheet)

                        <a href="{{ asset('uploads/datasheets/'.$sheet) }}"
                           target="_blank"
                           class="btn btn-primary me-2 mb-2">

                            View Datasheet

                        </a>

                    @endforeach

                @else

                    <p>
                        No Datasheet Uploaded
                    </p>

                @endif

            </div>

            {{-- BUTTON --}}
            <div class="mt-5 text-end">

                <button type="submit"
                        class="btn btn-primary">

                    Update Status

                </button>

            </div>

        </form>

    </div>

</div>

@endsection