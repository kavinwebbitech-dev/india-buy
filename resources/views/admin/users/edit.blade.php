@extends('admin.layouts.app')

@section('page-title', 'Edit User')

@section('content')

<div class="main">

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit User</h4>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}"
              method="POST"
              id="userForm">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           placeholder="Enter Name">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           placeholder="Enter Email" readonly>

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>

                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone', $user->phone) }}"
                           placeholder="Enter Phone">

                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- State -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">State</label>

                    <input type="text"
                           name="state"
                           class="form-control"
                           value="{{ old('state', $user->state) }}"
                           placeholder="Enter State">

                    @error('state')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">City</label>

                    <input type="text"
                           name="city"
                           class="form-control"
                           value="{{ old('city', $user->city) }}"
                           placeholder="Enter City">

                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                

                <!-- Status -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="1"
                            {{ $user->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ $user->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update User
                </button>
            </div>

        </form>

    </div>

</div>

@endsection


@section('scripts')

<script>
$(document).ready(function () {

    $("#userForm").validate({

        rules: {

            name: {
                required: true,
                minlength: 2
            },

            email: {
                required: true,
                email: true
            },

            phone: {
                required: true
            },

            state: {
                required: true
            },

            city: {
                required: true
            },

            password: {
                minlength: 6
            }

        },

        messages: {

            name: {
                required: "Enter name"
            },

            email: {
                required: "Enter email"
            },

            phone: {
                required: "Enter phone number"
            },

            state: {
                required: "Enter state"
            },

            city: {
                required: "Enter city"
            },

            password: {
                minlength: "Password minimum 6 characters"
            }

        },

        errorElement: "span",
        errorClass: "text-danger",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }

    });

});
</script>

@endsection