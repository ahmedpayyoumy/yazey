{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($script)) {
        $route = route('scripts.create');
        $title = 'Thêm mới';
    } else {
        $route = route('scripts.update', $script->id);
        $title = 'Cập nhật';
    }
@endphp
@section('title', $title . ' Script')
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
                        <h3 class="card-label">{{ $title }} Script
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên script</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="title" placeholder="Nhập tên script" value="{{ $script->title ?? '' }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Script Header</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="script_header" rows="10">{{ old('script_header') ?? ($script->script_header ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Script Footer</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="script_footer" rows="10">{{ old('script_footer') ?? ($script->script_footer ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-0">
                            <label>Chọn option:</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="option">
                                        <span class="option-control">
                                            <span class="radio">
                                                <input type="radio" name="option_compare" value="all" {{
    old('option_compare') === 'all' ? 'checked':
    (empty($script) ? 'checked' : ($script->option_compare === 'all' ? 'checked' : ''))
    }}/>
                                            <span></span>
                                            </span>
                                        </span>
                                        <span class="option-label">
                                             <span class="option-head">
                                                <span class="option-title">
                                                 Tất cả các trang
                                                </span>
                                             </span>
                                             <span class="option-body">
                                                Apply cho tất cả các trang
                                             </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="option">
                                        <span class="option-control">
                                            <span class="radio">
                                                <input type="radio" name="option_compare" value="exactly" {{ old('option_compare') === 'all' ? 'checked' : (!empty($script) && $script->option_compare === 'exactly' ? 'checked' : '') }}/>
                                            <span></span>
                                            </span>
                                        </span>
                                        <span class="option-label">
                                             <span class="option-head">
                                                <span class="option-title">
                                                 Một trang duy nhất
                                                </span>
                                             </span>
                                             <span class="option-body">
                                                <select class="form-control select2" id="kt_select2_pages" name="option_value_exactly">
                                                    @foreach($pages as $page)
                                                        <option value="{{ $page->id }}" {{ (old('option_value_exactly') && $page->id == old('option_value_exactly')) || !empty($script) && $page->id == $script->option_value ? 'selected' : '' }}>{{ $page->title }}</option>
                                                    @endforeach
                                                </select>
                                             </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="option">
                                        <span class="option-control">
                                            <span class="radio">
                                                <input type="radio" name="option_compare" value="contain" {{ old('option_compare') === 'all' ? 'checked' : (!empty($script) && $script->option_compare === 'contain' ? 'checked' : '') }}/>
                                            <span></span>
                                            </span>
                                        </span>
                                        <span class="option-label">
                                             <span class="option-head">
                                                <span class="option-title">
                                                 Website có url bao gồm
                                                </span>
                                             </span>
                                             <span class="option-body">
                                                <input type="text" class="form-control" name="option_value_contain" placeholder="Nhập kí tự" value="{{ old('option_value_contain') ?? (!empty($script) && $script->option_compare === 'contain' ? $script->option_value : '') }}"/>
                                             </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="option">
                                        <span class="option-control">
                                            <span class="radio">
                                                <input type="radio" name="option_compare" value="not_contain" {{ old('option_compare') === 'not_contain' ? 'checked' : (!empty($script) && $script->option_compare === 'not_contain' ? 'checked' : '') }}/>
                                            <span></span>
                                            </span>
                                        </span>
                                        <span class="option-label">
                                             <span class="option-head">
                                                <span class="option-title">
                                                 Website có url không bao gồm
                                                </span>
                                             </span>
                                             <span class="option-body">
                                                <input type="text" class="form-control" name="option_value_not_contain" placeholder="Nhập kí tự" value="{{ old('option_value_not_contain') ?? ( !empty($script) && $script->option_compare === 'not_contain' ? $script->option_value : '') }}"/>
                                             </span>
                                        </span>
                                    </label>
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
                                <a href="{{ route('scripts.list') }}" class="btn btn-secondary">Hủy</a>
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
                            message: 'Hãy nhập tên script.'
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

    $('#kt_select2_pages').select2({
        placeholder: 'Chọn trang'
    });
</script>
@endsection