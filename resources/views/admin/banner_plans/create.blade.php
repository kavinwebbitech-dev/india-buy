@extends('admin.layouts.app')

@section('page-title', 'Create Banner Plan')

@section('content')
<div class="main py-4">
    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        
        <!-- Header Section -->
        <div class="card-header bg-white border-bottom border-light py-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Create Banner Plan</h4>
                <p class="text-muted small mb-0">Set up pricing, duration configurations, and display limits for vendor banner plans.</p>
            </div>
            <a href="{{ route('admin.bannerplans.index') }}" class="btn btn-light border btn-sm px-3 py-2 rounded-3 text-secondary fw-semibold transition-all">
                <i class="fa fa-arrow-left me-2 small"></i> Back to List
            </a>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4">
            <form id="bannerPlanForm" action="{{ route('admin.bannerplans.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    <!-- Plan Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Plan Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa fa-tag small"></i></span>
                            <input type="text" name="plan_name" class="form-control bg-light-focus border-start-0 rounded-end-3 py-2.5 placeholder-muted" placeholder="e.g. Premium Sidebar Pack">
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Price (₹)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted fw-bold">₹</span>
                            <input type="number" name="price" class="form-control bg-light-focus border-start-0 rounded-end-3 py-2.5 placeholder-muted" placeholder="0.00">
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Duration (Days)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa fa-calendar-alt small"></i></span>
                            <input type="number" name="duration" class="form-control bg-light-focus border-start-0 rounded-end-3 py-2.5 placeholder-muted" placeholder="30">
                        </div>
                    </div>

                    <!-- Max Banners -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Max Banners Allowed</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa fa-images small"></i></span>
                            <input type="number" name="max_banners" class="form-control bg-light-focus border-start-0 rounded-end-3 py-2.5" value="1">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="fa fa-toggle-on small"></i></span>
                            <select name="status" class="form-select bg-light-focus border-start-0 rounded-end-3 py-2.5">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Plan Description</label>
                        <textarea name="description" class="form-control bg-light-focus rounded-3 py-2.5 placeholder-muted" rows="3" placeholder="Describe the perks, location visibility, or specs of this banner plan..."></textarea>
                    </div>

                </div>

                <!-- Actions Line -->
                <div class="mt-5 pt-3 border-top border-light d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light px-4 py-2.5 rounded-3 fw-semibold text-muted small">
                        Reset Changes
                    </button>
                    <button type="submit" class="btn btn-dark px-4 py-2.5 rounded-3 fw-semibold small shadow-sm hover-lift">
                        <i class="fa fa-check-circle me-2"></i> Save Plan Config
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Premium Look enhancements inside view file */
    .bg-light-focus {
        background-color: #fafafa;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease-in-out;
    }
    .bg-light-focus:focus {
        background-color: #ffffff;
        border-color: #0f172a; /* Dark sleek focus */
        box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.08);
    }
    .input-group-text {
        border: 1px solid #e2e8f0;
        color: #64748b !important;
    }
    .placeholder-muted::placeholder {
        color: #94a3b8;
        font-size: 0.875rem;
    }
    .hover-lift:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15) !important;
    }
    .text-danger.invalid-feedback-custom {
        font-size: 0.785rem;
        font-weight: 500;
        margin-top: 5px;
        display: block;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    $("#bannerPlanForm").validate({
        rules: {
            plan_name: { required: true, minlength: 2 },
            price: { required: true, number: true, min: 0 },
            duration: { required: true, digits: true, min: 1 },
            max_banners: { required: true, digits: true, min: 1 }
        },
        messages: {
            plan_name: { required: "Plan name is required", minlength: "Minimum 2 characters required" },
            price: { required: "Price is required", number: "Enter a valid amount" },
            duration: { required: "Duration sequence is required", digits: "Only numbers allowed" },
            max_banners: { required: "Maximum banners metric is required", digits: "Only numbers allowed" }
        },
        errorElement: "span",
        errorClass: "text-danger invalid-feedback-custom",
        highlight: function(element) {
            $(element).closest('.input-group').find('.form-control, .input-group-text').addClass("border-danger").removeClass("border-dark");
        },
        unhighlight: function(element) {
            $(element).closest('.input-group').find('.form-control, .input-group-text').removeClass("border-danger");
        }
    });

});
</script>
@endsection