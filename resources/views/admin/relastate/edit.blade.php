{{-- resources/views/admin/relastate/edit.blade.php --}}

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

        <form action="{{ route('admin.properties.update', $property->id) }}"
              method="POST">

            @csrf
            @method('POST')

            {{-- PROPERTY IMAGES --}}
            <div class="mb-5">

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

                        <div class="col-md-3 mb-3">

                            <img src="{{ asset('uploads/relastate/images/'.$img) }}"
                                 class="property-image">

                        </div>

                    @empty

                        <div class="col-md-12">

                            <p>No Images Found</p>

                        </div>

                    @endforelse

                </div>

            </div>

            {{-- PROPERTY DETAILS --}}
            <div class="row g-4">

                {{-- PROPERTY TITLE --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Property Title
                    </label>

                    <div class="readonly-box">

                        {{ $property->property_title ?? '-' }}

                    </div>

                </div>

                {{-- PROPERTY TYPE --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Property Type
                    </label>

                    <div class="readonly-box">

                        {{ $property->property_type ?? '-' }}

                    </div>

                </div>

                {{-- PROPERTY FOR --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Property For
                    </label>

                    <div class="readonly-box">

                        {{ $property->property_for ?? '-' }}

                    </div>

                </div>

                {{-- CATEGORY --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Category
                    </label>

                    <div class="readonly-box">

                        {{ $property->categoryData->category_name ?? '-' }}

                    </div>

                </div>

                {{-- SUB CATEGORY --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Sub Category
                    </label>

                    <div class="readonly-box">

                        {{ $property->subCategoryData->sub_category_name ?? '-' }}

                    </div>

                </div>

                {{-- STATE --}}
                <div class="col-md-6">

                    <label class="label-title">
                        State
                    </label>

                    <div class="readonly-box">

                        {{ $property->state ?? '-' }}

                    </div>

                </div>

                {{-- CITY --}}
                <div class="col-md-6">

                    <label class="label-title">
                        City
                    </label>

                    <div class="readonly-box">

                        {{ $property->city ?? '-' }}

                    </div>

                </div>

                {{-- LANDMARK --}}
                <div class="col-md-6">

                    <label class="label-title">
                        Landmark
                    </label>

                    <div class="readonly-box">

                        {{ $property->landmark ?? '-' }}

                    </div>

                </div>

                {{-- ADDRESS --}}
                <div class="col-md-12">

                    <label class="label-title">
                        Address
                    </label>

                    <div class="readonly-box">

                        {!! nl2br(e($property->address ?? '-')) !!}

                    </div>

                </div>

                {{-- DESCRIPTION --}}
                <div class="col-md-12">

                    <label class="label-title">
                        Description
                    </label>

                    <div class="readonly-box">

                        {!! nl2br(e($property->descripction ?? '-')) !!}

                    </div>

                </div>

            </div>

            {{-- SPECIFICATIONS --}}
            <div class="mt-5">

                <h5 class="mb-3">
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

            {{-- FEATURES --}}
            <div class="mt-5">

                <h5 class="mb-3">
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

            {{-- DATASHEET --}}
            <div class="mt-5">

                <h5 class="mb-3">
                    Datasheets
                </h5>

                @php

                    $datasheets = json_decode($property->documents, true);

                    if (!is_array($datasheets)) {
                        $datasheets = [];
                    }

                @endphp

                <div class="d-flex flex-wrap gap-2">

                    @forelse($datasheets as $file)

                        <a href="{{ asset('uploads/relastate/documents/'.$file) }}"
                           target="_blank"
                           class="btn btn-primary">

                            View Datasheet

                        </a>

                    @empty

                        <p>No Datasheet Uploaded</p>

                    @endforelse

                </div>

            </div>

            {{-- STATUS --}}
            <div class="mt-5">

                <label class="label-title">
                    Status
                </label>

                <select name="status"
                        class="form-control">

                    <option value="1"
                        {{ $property->status == 1 ? 'selected' : '' }}>

                        Active

                    </option>

                    <option value="0"
                        {{ $property->status == 0 ? 'selected' : '' }}>

                        Inactive

                    </option>

                </select>

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