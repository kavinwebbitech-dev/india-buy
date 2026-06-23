{{-- resources/views/admin/service/edit.blade.php --}}

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

        .label-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #6b7280;
        }

        .readonly-box {
            width: 100%;
            min-height: 45px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px 14px;
            background: #f8fafc;
            font-size: 14px;
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
                    Edit Service
                </li>

            </ol>

        </nav>

        {{-- CARD --}}
        <div class="card-custom p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4>
                    Service Details
                </h4>

                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">

                    Back

                </a>

            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success">

                    {{ session('success') }}

                </div>
            @endif

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">

                @csrf
                @method('POST')

                {{-- SERVICE IMAGES --}}
                <div class="mb-5">

                    <h5 class="mb-3">
                        Service Images11
                    </h5>





                    @php
                        // dd($service->service_img)
                        $images = json_decode($service->service_img, true);

                        if (!is_array($images)) {
                            $images = [];
                        }
                    @endphp

                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('uploads/service/images/' . $image) }}" class="service-image">
                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- SERVICE DETAILS --}}
                <div class="row g-4">

                    {{-- SERVICE NAME --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Service Name
                        </label>

                        <div class="readonly-box">

                            {{ $service->service_name }}

                        </div>

                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Category
                        </label>

                        <div class="readonly-box">

                            {{ $service->categoryData->category_name ?? '-' }}

                        </div>

                    </div>

                    {{-- SUB CATEGORY --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Sub Category
                        </label>

                        <div class="readonly-box">

                            {{ $service->subCategoryData->sub_category_name ?? '-' }}

                        </div>

                    </div>

                    {{-- PRICE TYPE --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Price Type
                        </label>

                        <div class="readonly-box">

                            {{ $service->price_type ?? '-' }}

                        </div>

                    </div>

                    {{-- SERVICE STATE --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Service State
                        </label>

                        <div class="readonly-box">

                            {{ $service->service_state ?? '-' }}

                        </div>

                    </div>

                    {{-- SERVICE CITY --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Service City
                        </label>

                        <div class="readonly-box">

                            {{ $service->service_city ?? '-' }}

                        </div>

                    </div>

                    {{-- AVAILABLE DAYS --}}
                    <div class="col-md-6">

                        <label class="label-title">
                            Available Days
                        </label>

                        <div class="readonly-box">

                            {{ str_replace('"', '', $service->available_days) }}

                        </div>

                    </div>

                    {{-- OPENING TIME --}}
                    <div class="col-md-3">

                        <label class="label-title">
                            Opening Time
                        </label>

                        <div class="readonly-box">

                            {{ $service->opening_time ? \Carbon\Carbon::parse($service->opening_time)->format('h:i A') : '-' }}

                        </div>

                    </div>

                    {{-- CLOSING TIME --}}
                    <div class="col-md-3">

                        <label class="label-title">
                            Closing Time
                        </label>

                        <div class="readonly-box">

                            {{ $service->closing_time ? \Carbon\Carbon::parse($service->closing_time)->format('h:i A') : '-' }}

                        </div>

                    </div>

                    {{-- SHORT DESCRIPTION --}}
                    <div class="col-md-12">

                        <label class="label-title">
                            Short Description
                        </label>

                        <div class="readonly-box">

                            {{ $service->short_description ?? '-' }}

                        </div>

                    </div>

                    {{-- LONG DESCRIPTION --}}
                    <div class="col-md-12">

                        <label class="label-title">
                            Long Description
                        </label>

                        <div class="readonly-box">

                            {!! nl2br(e($service->long_description)) !!}

                        </div>

                    </div>

                </div>

                {{-- FEATURES --}}
                <div class="mt-5">

                    <h5 class="mb-3">
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

                                            No Features Found

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

                    @if ($service->datasheet)
                        <a href="{{ asset('uploads/service/datasheet/' . $service->datasheet) }}" target="_blank"
                            class="btn btn-primary">

                            View Datasheet

                        </a>
                    @else
                        <p>
                            No Datasheet Uploaded
                        </p>
                    @endif

                </div>

                {{-- STATUS --}}
                <div class="mt-5">

                    <label class="label-title">
                        Status
                    </label>

                    <select name="status" class="form-control">

                        <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                {{-- BUTTON --}}
                <div class="mt-5 text-end">

                    <button type="submit" class="btn btn-primary">

                        Update Status

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
