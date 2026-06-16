@extends('admin.layouts.app')

@section('page-title', 'Edit Vendor')

@section('content')

<div class="main">

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>Edit Vendor</h4>

            <a href="{{ route('admin.vendors.index') }}"
               class="btn btn-secondary">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>

        <form action="{{ route('admin.vendors.update', $vendor->id) }}"
              method="POST"
              enctype="multipart/form-data"
              id="vendorForm">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- LOGO --}}
                <div class="col-md-12 mb-4 text-center">

                    @if($vendor->company_logo)

                        <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                             class="rounded-circle border"
                             width="120"
                             height="120"
                             style="object-fit:cover;">

                    @else

                        <img src="https://placehold.co/120x120?text=Logo"
                             class="rounded-circle border"
                             width="120"
                             height="120">

                    @endif

                </div>

                {{-- COMPANY NAME --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Company Name
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->company_name }}"
                           readonly>

                </div>

                {{-- EMAIL --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           class="form-control"
                           value="{{ $vendor->email }}"
                           readonly>

                </div>

                {{-- PHONE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->phone }}"
                           readonly>

                </div>

                {{-- GST --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        GST No
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->gst_no }}"
                           readonly>

                </div>

                {{-- VENDOR TYPE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Vendor Type
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->vendorType->vendor_name ?? '-' }}"
                           readonly>

                </div>

                {{-- BUSINESS TYPE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Business Type
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->businessType->business_name ?? '-' }}"
                           readonly>

                </div>

                {{-- CATEGORY --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->category->category_name ?? '-' }}"
                           readonly>

                </div>

                {{-- SUB CATEGORY --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Sub Category
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->subCategory->sub_category_name ?? '-' }}"
                           readonly>

                </div>

                {{-- YEAR --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Year Established
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->year_established }}"
                           readonly>

                </div>

                {{-- COUNTRY --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Country
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->country }}"
                           readonly>

                </div>

                {{-- STATE --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        State
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->state }}"
                           readonly>

                </div>

                {{-- CITY --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        City
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->city }}"
                           readonly>

                </div>

                {{-- ADDRESS --}}
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Address
                    </label>

                    <textarea rows="3"
                              class="form-control"
                              readonly>{{ $vendor->address }}</textarea>

                </div>

                {{-- ABOUT --}}
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        About Us
                    </label>

                    <textarea rows="4"
                              class="form-control"
                              readonly>{{ $vendor->about_us }}</textarea>

                </div>

                {{-- EMAIL VERIFIED --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Email Verified
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $vendor->email_verify == 1 ? 'Verified' : 'Not Verified' }}"
                           readonly>

                </div>

                {{-- STATUS --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

                        <option value="1"
                            {{ $vendor->status == 1 ? 'selected' : '' }}>

                            Approved

                        </option>

                        <option value="0"
                            {{ $vendor->status == 0 ? 'selected' : '' }}>

                            Pending

                        </option>

                    </select>

                    @error('status')

                        <span class="text-danger">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fa fa-save"></i>

                    Update Status

                </button>

            </div>

        </form>

    </div>

</div>

@endsection