{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($faq)) {
        $route = route('faq.create');
        $title = 'Thêm mới';
    } else {
        $route = route('faq.update', $faq->id);
        $title = 'Cập nhật';
    }
@endphp
@section('title', $title . ' faq')
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
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{ $title }} FAQ
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-12 col-form-label">Câu hỏi</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="question" placeholder="Nhập câu hỏi" value="{{ $faq->question ?? '' }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 col-form-label">Câu trả lời</label>
                            <div class="col-lg-12">
                                <div class="tinymce">
                                    <textarea id="kt-tinymce" name="answer" class="tox-target">
                                        {{ old('answer') ?? ($faq->answer ?? '') }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">
                                    {{ $title }}
                                </button>
                                <a href="{{ route('faq.list') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    FormValidation.formValidation(
        document.getElementById('kt_form'),
        {
            fields: {
                question: {
                    validators: {
                        notEmpty: {
                            message: 'Hãy nhập câu hỏi.'
                        },
                    }
                },
                answer: {
                    validators: {
                        notEmpty: {
                            message: 'Hãy nhập câu trả lời.'
                        },
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            }
        },
    )

    tinymce.init({
        selector: '#kt-tinymce',
        menubar: false,
        toolbar: ['styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code | forecolor backcolor'],
        plugins : 'advlist autolink link image imagetools lists charmap print preview code textcolor colorpicker',
        textcolor_map: [
            "D1823D", "Index"
        ],
        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,

        /*URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)*/
        images_upload_url: "{{ route('api.image.upload') }}",
    });
</script>
@endsection
