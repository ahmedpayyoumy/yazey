{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($post)) {
        $route = route('blog.pages.create');
        $title = 'Add new';
    } else {
        $route = route('blog.pages.update', $post->id);
        $title = 'Edit';
    }
@endphp
@section('title', $title . ' Page')
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
                        <h3 class="card-label">{{ $title }} Page
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="title" placeholder="Name" value="{{ old('title') ?? ($post->title ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Slug</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="slug" placeholder="" value="{{ old('slug') ?? ($post->slug ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Image</label>
                            <div class="col-lg-9">
                                <div class="image-input image-input-outline" id="kt_feature_image">
                                    <div class="image-input-wrapper" style="background-image: url({{ !empty($post->feature_image) ? Storage::url($post->feature_image) : asset('media/users/blank.png') }})"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Upload hình">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="feature_image" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="feature_image_remove"/>
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Bỏ hình ảnh"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Category</label>
                            <div class="col-lg-9">
                                <select class="form-control select2" id="kt_select2_categories" name="categories[]" multiple="multiple">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('categories') && in_array($category->id, old('categories')) || !empty($post) && in_array($category->id, $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tag</label>
                            <div class="col-lg-9">
                                <select class="form-control select2" id="kt_select2_tags" name="tags[]" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ (old('tags') && in_array($tag->id, old('tags')) || !empty($post) && in_array($tag->id, $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $tag->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 col-form-label">Content</label>
                            <div class="col-lg-12">
                                <div class="tinymce">
                                    <textarea id="kt-tinymce" name="content" class="tox-target">
                                        {{ old('content') ?? ($post->content ?? '') }}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <h3>Meta</h3>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Title</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{ old('meta_title') ?? ($post->metas['meta_title'] ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Description</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="meta_description" placeholder="Description" value="{{ old('meta_description') ?? ($post->metas['meta_description'] ?? '') }}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Image URL</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="meta_image" placeholder="Image URL" value="{{ old('meta_image') ?? ($post->metas['meta_image'] ?? '') }}"/>
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
                                <a href="{{ route('blog.pages.list') }}" class="btn btn-secondary">Cancel</a>
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
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Hãy nhập tên trang.'
                            },
                        }
                    },
                    slug: {
                        validators: {
                            notEmpty: {
                                message: 'Hãy nhập slug trang.'
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
        );

        tinymce.init({
            selector: '#kt-tinymce',
            menubar: false,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify lineheight',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
            plugins : 'advlist autolink link image imagetools lists charmap print preview code',
            // images_upload_handler: example_image_upload_handler
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,

            /*URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)*/
            images_upload_url: "{{ route('api.image.upload') }}",
            lineheight_formats: "1 1.1 1.2 1.3 1.4 1.5 2",
            setup: function(e) {
                e.on('change', onChangeTinymce);
            },
            body_class: "post__content",
            content_css: "/css/app.css",
            formats: {
                alignleft: {selector: 'span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'left'}},
                aligncenter: {selector: 'span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'center'}},
                alignright: {selector: 'span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'right'}},
                alignjustify: {selector: 'span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'full'}}
            }
        });

        $('#kt_select2_categories').select2({
            placeholder: 'Select Category'
        });

        $('#kt_select2_tags').select2({
            placeholder: 'Select tag'
        });

        var featureImage = new KTImageInput('kt_feature_image');

        $('input[name=title], input[name=slug]').keyup(function(){
            let title = $(this).val();
            $('input[name=slug]').val(changeToSlug(title));
        });

        function changeToSlug(input)
        {
            let slug = input.toLowerCase();

            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            slug = slug.replace(/ /gi, "-");
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return slug;
        }
    </script>
@endsection
