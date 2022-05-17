{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Contact')
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
            <!--begin:: Information-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-body">
                            <!--begin::Heading-->
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h5 class="font-weight-bold mb-6">Question:</h5>
                                </div>
                            </div>
                            <!--begin::Form Group-->
                            <div class="row">
                                <label class="text-right col-lg-3 col-sm-12">Name</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div>
                                        {!! $contactForm->contact->name !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="text-right col-lg-3 col-sm-12">Email</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    {!! $contactForm->contact->email !!}
                                </div>
                            </div>
                            <div class="row">
                                <label class="text-right col-lg-3 col-sm-12">Phone Number</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    {!! $contactForm->contact->phone_number !!}
                                </div>
                            </div>
                            <div class="row">
                                <label class="text-right col-lg-3 col-sm-12">Question</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div>
                                        {!! $contactForm->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin:: Information-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-body">
                            <!--begin::Heading-->
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h5 class="font-weight-bold mb-6">Replies:</h5>
                                </div>
                            </div>
                            <!--begin::Form Group-->
                            @foreach ($contactForm->replies as $reply)
                                <div class="row">
                                    <label class="text-right col-lg-3 col-sm-12">Name</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div>
                                            {!! $reply->user->name !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="text-right col-lg-3 col-sm-12">Answer</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div>
                                            {!! $reply->content !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin:: Information-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-12">
                    <!--begin::Card-->
                    <form enctype="multipart/form-data" action="{{ route('contact-form.reply', $contactForm->id ) }}" method="POST">
                        @csrf
                        <div class="card card-custom">
                            <!--begin::Form-->
                                <div class="card-body">
                                    <!--begin::Heading-->
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h5 class="font-weight-bold mb-6">Reply:</h5>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Reply</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea name="content" class="summernote" id="kt_summernote_1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button type="submit" class="btn btn-secondary">Cancel</button>
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
            <!--end::Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('scripts')
<script src="{{ asset('js/pages/crud/forms/editors/summernote.js') }} "></script>
@toastr_js
@toastr_render
@endsection
