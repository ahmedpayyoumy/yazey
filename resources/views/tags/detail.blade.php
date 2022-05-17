{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($tag)) {
        $route = route('blog.tags.create');
        $title = 'Thêm mới';
    } else {
        $route = route('blog.tags.update', $tag->id);
        $title = 'Cập nhật';
    }
@endphp
@section('title', $title . 'Tag')
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
                        <h3 class="card-label">{{ $title }} Tag
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên tag</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="title" placeholder="Nhập tên tag" value="{{ $tag->title ?? '' }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mô tả</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description" placeholder="Nhập mô tả" rows="3">{{ $tag->description ?? '' }}</textarea>
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
                                <a href="{{ route('blog.tags.list') }}" class="btn btn-secondary">Hủy</a>
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
    <script>
        FormValidation.formValidation(
            document.getElementById('kt_form'),
            {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Hãy nhập tên tag.'
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
    </script>
@endsection