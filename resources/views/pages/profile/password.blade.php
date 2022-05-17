{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Thống kê')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
@endsection
{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Account Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                    @include('pages.profile.card')
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <form action="{{ route('profile.myPasswordPost') }}" method="POST">
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Account Information</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account settings</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input name="current_password" type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current password" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input name="new_password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="New password" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input name="verify_password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Verify password" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </form>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Account Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('scripts')
@jquery
@toastr_js
@toastr_render
<script src="{{ asset('js/pages/custom/profile/profile.js') }} "></script>
@endsection
