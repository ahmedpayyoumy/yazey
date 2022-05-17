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
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="d-flex flex-row">
                <div class="flex-row-fluid">
                    <form enctype="multipart/form-data" action="{{ route('media-file.store') }}" method="POST">
                        @csrf
                        <div class="card card-custom">
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Media</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Upload new Media</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mb-6">Category:</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <select name="media_category" class="form-control datatable-input" data-col-index="6">
                                            <option value="">Select</option>
                                            @foreach ($mediaCategorys as $mediaCategory)
                                            <option
                                            @if (request()->get('cat') == $mediaCategory->id))
                                                selected="selected"
                                            @endif
                                            value="{{ $mediaCategory->id }}">{{ $mediaCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-right"></label>
                                    <div class="col-lg-6 col-md-9 col-sm-12">
                                        <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                            <div class="dropzone-msg dz-message needsclick">
                                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                                <span class="dropzone-msg-desc">This is just a demo dropzone. Selected files are
                                                <strong>not</strong>actually uploaded.</span>
                                                <input type="hidden" name="file_url" value="" id="file-url">
                                                <input type="hidden" name="name" value="" id="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var config = {
        routes: {
            upload: "{{ route('media-file/upload') }}"
        }
    };
</script>
<script src="{{ asset('js/upload.js') }}"></script>
@toastr_js
@toastr_render
@endsection
