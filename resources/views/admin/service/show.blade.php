{{-- resources/views/admin/service/show.blade.php --}}

@extends('admin.layouts.app')

@section('page-title', 'Service Details')

@section('content')

    <style>
        .service-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #ddd;
        }

        .info-title {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
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

                    <a href="{{ route('admin.services.index') }}">
                        Services
                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Service Details

                </li>

            </ol>

        </nav>

        <div class="card-custom p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4>
                    Service Details
                </h4>

                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">

                    Back

                </a>

            </div>

            <div class="row">

                {{-- IMAGES --}}
                <div class="col-md-4">

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <h5 class="mb-3">
                                Service Images111
                            </h5>



                            @php
                                $images = json_decode($service->service_img, true);

                                if (!is_array($images)) {
                                    $images = [];
                                }
                            @endphp

                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="col-6 mb-3">
                                        <img src="{{ asset('uploads/service/images/' . $image) }}" class="service-image">
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>

                {{-- DETAILS --}}
                <div class="col-md-8">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <div class="row g-4">

                                {{-- SERVICE NAME --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Service Name
                                    </div>

                                    <div class="info-value">
                                        {{ $service->service_name }}
                                    </div>

                                </div>

                                {{-- CATEGORY --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Category
                                    </div>

                                    <div class="info-value">
                                        {{ $service->categoryData->category_name ?? '-' }}
                                    </div>

                                </div>

                                {{-- SUB CATEGORY --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Sub Category
                                    </div>

                                    <div class="info-value">
                                        {{ $service->subCategoryData->sub_category_name ?? '-' }}
                                    </div>

                                </div>

                                {{-- VENDOR --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Company Name
                                    </div>

                                    <div class="info-value">
                                        {{ $service->vendor->company_name ?? '-' }}
                                    </div>

                                </div>

                                {{-- EMAIL --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Company Email
                                    </div>

                                    <div class="info-value">
                                        {{ $service->vendor->email ?? '-' }}
                                    </div>

                                </div>

                                {{-- PHONE --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Company Phone
                                    </div>

                                    <div class="info-value">
                                        {{ $service->vendor->phone ?? '-' }}
                                    </div>

                                </div>

                                {{-- LOCATION --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Service Location
                                    </div>

                                    <div class="info-value">

                                        {{ $service->service_city ?? '-' }},
                                        {{ $service->service_state ?? '-' }}

                                    </div>

                                </div>

                                {{-- PRICE TYPE --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Price Type
                                    </div>

                                    <div class="info-value">
                                        {{ $service->price_type ?? '-' }}
                                    </div>

                                </div>

                                {{-- AVAILABLE DAYS --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Available Days
                                    </div>

                                    <div class="info-value">

                                        {{ str_replace('"', '', $service->available_days) }}

                                    </div>

                                </div>

                                {{-- SERVICE TIME --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Service Time
                                    </div>

                                    <div class="info-value">

                                        {{ $service->opening_time ? \Carbon\Carbon::parse($service->opening_time)->format('h:i A') : '-' }}

                                        -

                                        {{ $service->closing_time ? \Carbon\Carbon::parse($service->closing_time)->format('h:i A') : '-' }}

                                    </div>

                                </div>

                                {{-- STATUS --}}
                                <div class="col-md-6">

                                    <div class="info-title">
                                        Status
                                    </div>

                                    <div>

                                        @if ($service->status == 1)
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
                                        {{ $service->short_description ?? '-' }}
                                    </div>

                                </div>

                                {{-- LONG DESCRIPTION --}}
                                <div class="col-md-12">

                                    <div class="info-title">
                                        Long Description
                                    </div>

                                    <div class="info-value">
                                        {!! nl2br(e($service->long_description)) !!}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- FEATURES --}}
            <div class="card shadow-sm mt-4">

                <div class="card-body">

                    <h5 class="mb-4">
                        Service Features
                    </h5>

                    @php

                        $features = json_decode($service->feature, true);

                        if (!is_array($features)) {
                            $features = [];
                        }

                    @endphp

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>
                                        Features
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @if (!empty($features))

                                    @foreach ($features as $feature)
                                        <tr>

                                            <td>

                                                @if (is_array($feature))
                                                    {{ implode(', ', $feature) }}
                                                @else
                                                    {{ $feature }}
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>

                                        <td class="text-center">
                                            No Features
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

                    @if ($service->datasheet)
                        <a href="{{ asset('uploads/service/datasheet/' . $service->datasheet) }}" target="_blank"
                            class="btn btn-primary btn-sm">

                            View Datasheet

                        </a>
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
