{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Settings')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

{{-- Content --}}
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <form class="form" method="post" action="{{ route('settings.update') }}" id="kt_form" enctype="multipart/form-data">
                @csrf
                <!-- Contact -->
                <div class="card card-custom my-5">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Liên hệ</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email liên hệ</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" name="contact_email" placeholder="Nhập email liên hệ" value="{{ old('contact_email') ?? ($settings['contact_email'] ?? '') }}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Địa chỉ</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="contact_location" placeholder="Nhập địa chỉ" value="{{ old('contact_email') ?? ($settings['contact_location'] ?? '') }}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Số điện thoại</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="contact_phone_number" placeholder="Nhập số điện thoại" value="{{ old('contact_phone_number') ?? ($settings['contact_phone_number'] ?? '') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Logo -->
                <div class="card card-custom my-5">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Logo</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Logo hệ thống</label>
                            <div class="col-lg-9">
                                <div class="image-input image-input-outline" id="kt_logo">
                                    <div class="image-input-wrapper" style="background-image: url({{ !empty($settings['logo']) ? Storage::url($settings['logo']) : asset('media/users/blank.png') }})"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload hình">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Bỏ hình ảnh"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Analytics -->
                <div class="card card-custom my-5">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Google Analytics</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tracking ID</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="ga_tracking_id" placeholder="Nhập GA Tracking ID" value="{{ old('ga_tracking_id') ?? ($settings['ga_tracking_id'] ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">View ID</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="ga_view_id" placeholder="Nhập GA View ID" value="{{ old('ga_view_id') ?? ($settings['ga_view_id'] ?? '') }}"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Captcha -->
                <div class="card card-custom my-5">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Captcha</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Bật Captcha?</label>
                            <div class="col-lg-9">
                                <input type="hidden" value="0" name='captcha_enabled'>
                                <input data-switch="true" type="checkbox" name="captcha_enabled" value="1" {{ old('captcha_enabled') ? 'checked' : (!empty($settings['captcha_enabled']) && $settings['captcha_enabled'] ? 'checked' : '') }}/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Captcha Site Key</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="captcha_site_key" placeholder="Nhập Captcha Site Key" value="{{ old('captcha_site_key') ?? ($settings['captcha_site_key'] ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Captcha Secret</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="captcha_secret" placeholder="Nhập Captcha Secret" value="{{ old('captcha_secret') ?? ($settings['captcha_secret'] ?? '') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">
                                Cập nhật
                            </button>
                            <a href="{{ route('settings.detail') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('scripts')
<script>
    $('[data-switch=true]').bootstrapSwitch();
    var logo = new KTImageInput('kt_logo');
</script>
@endsection