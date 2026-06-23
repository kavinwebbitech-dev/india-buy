{{-- resources/views/admin/relastate/show.blade.php --}}

@extends('admin.layouts.app')

@section('page-title', 'Property Details')

@section('content')

<style>

    .property-image{
        width:100%;
        height:180px;
        object-fit:cover;
        border-radius:12px;
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
        word-break:break-word;
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

                <a href="{{ route('admin.properties.index') }}">
                    Properties
                </a>

            </li>

            <li class="breadcrumb-item active">

                Property Details

            </li>

        </ol>

    </nav>

    <div class="card-custom p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4>
                Real Estate Property Details
            </h4>

            <a href="{{ route('admin.properties.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="row">

            {{-- IMAGES --}}
            <div class="col-md-4">

                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="mb-3">
                            Property Images
                        </h5>

                        @php

                            $images = json_decode($property->proerty_image, true);

                            if (!is_array($images)) {
                                $images = [];
                            }

                        @endphp

                        <div class="row">

                            @forelse($images as $img)

                                <div class="col-6 mb-3">

                                    <img src="{{ asset('uploads/relastate/images/'.$img) }}"
                                         class="property-image">

                                </div>

                            @empty

                                <div class="col-12">

                                    <p>No Images Found</p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

            {{-- DETAILS --}}
            <div class="col-md-8">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="row g-4">

                            {{-- PROPERTY TITLE --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Property Title
                                </div>

                                <div class="info-value">
                                    {{ $property->property_title ?? '-' }}
                                </div>

                            </div>

                            {{-- PROPERTY TYPE --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Property Type
                                </div>

                                <div class="info-value">
                                    {{ $property->property_type ?? '-' }}
                                </div>

                            </div>

                            {{-- PROPERTY FOR --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Property For
                                </div>

                                <div class="info-value">
                                    {{ $property->property_for ?? '-' }}
                                </div>

                            </div>

                            {{-- CATEGORY --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Category
                                </div>

                                <div class="info-value">
                                    {{ $property->categoryData->category_name ?? '-' }}
                                </div>

                            </div>

                            {{-- SUB CATEGORY --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Sub Category
                                </div>

                                <div class="info-value">
                                    {{ $property->subCategoryData->sub_category_name ?? '-' }}
                                </div>

                            </div>

                            {{-- COMPANY NAME --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Company Name
                                </div>

                                <div class="info-value">
                                    {{ $property->vendor->company_name ?? '-' }}
                                </div>

                            </div>

                            {{-- COMPANY EMAIL --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Company Email
                                </div>

                                <div class="info-value">
                                    {{ $property->vendor->email ?? '-' }}
                                </div>

                            </div>

                            {{-- COMPANY PHONE --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Company Phone
                                </div>

                                <div class="info-value">
                                    {{ $property->vendor->phone ?? '-' }}
                                </div>

                            </div>

                            {{-- STATE --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    State
                                </div>

                                <div class="info-value">
                                    {{ $property->state ?? '-' }}
                                </div>

                            </div>

                            {{-- CITY --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    City
                                </div>

                                <div class="info-value">
                                    {{ $property->city ?? '-' }}
                                </div>

                            </div>

                            {{-- LANDMARK --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Landmark
                                </div>

                                <div class="info-value">
                                    {{ $property->landmark ?? '-' }}
                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <div class="info-title">
                                    Status
                                </div>

                                <div>

                                    @if($property->status == 1)

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

                            {{-- ADDRESS --}}
                            <div class="col-md-12">

                                <div class="info-title">
                                    Address
                                </div>

                                <div class="info-value">
                                    {!! nl2br(e($property->address ?? '-')) !!}
                                </div>

                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="col-md-12">

                                <div class="info-title">
                                    Description
                                </div>

                                <div class="info-value">
                                    {!! nl2br(e($property->descripction ?? '-')) !!}
                                </div>

                            </div>

                        </div>

                    </div>

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

                    $specifications = json_decode($property->specification, true);

                    if (!is_array($specifications)) {
                        $specifications = [];
                    }

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

                            @forelse($specifications as $spec)

                                <tr>

                                    <td>

                                        {{ $spec['key'] ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $spec['value'] ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="2" class="text-center">

                                        No Specifications Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- FEATURES --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Features
                </h5>

                @php

                    $features = json_decode($property->features, true);

                    if (!is_array($features)) {
                        $features = [];
                    }

                @endphp

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th width="40%">
                                    Feature
                                </th>

                                <th>
                                    Value
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($features as $feature)

                                <tr>

                                    <td>

                                        {{ $feature['key'] ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $feature['value'] ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="2" class="text-center">

                                        No Features Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- DATASHEETS --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="mb-4">
                    Datasheets
                </h5>

                @php


                    $datasheets = json_decode($property->documents, true);
                    if (!is_array($datasheets)) {
                        $datasheets = [];
                    }

                @endphp

                @if(count($datasheets) > 0)

                    <div class="d-flex flex-wrap gap-2">

                        @foreach($datasheets as $file)

                            <a href="{{ asset('uploads/relastate/documents/'.$file) }}"
                               target="_blank"
                               class="btn btn-primary btn-sm">

                                View Datasheet

                            </a>

                        @endforeach

                    </div>

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