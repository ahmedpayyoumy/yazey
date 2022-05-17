{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($category)) {
        $route = route('blog.categories.create');
        $title = 'Add new';
    } else {
        $route = route('blog.categories.update', $category->id);
        $title = 'Edit';
    }
@endphp
@section('title', $title . ' Category')
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
                        <h3 class="card-label">{{ $title }} Category
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="title" placeholder="Nhập tên chuyên mục" value="{{ $category->title ?? '' }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description" placeholder="Nhập mô tả" rows="3">{{ $category->description ?? '' }}</textarea>
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
                                <a href="{{ route('blog.categories.list') }}" class="btn btn-secondary">Hủy</a>
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
                            message: 'Input category name.'
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