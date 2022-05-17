{{-- Extends layout --}}
@extends('layout.default')

@php
    if (empty($post)) {
        $route = route('blog.posts.create');
        $title = 'Add new';
    } else {
        $route = route('blog.posts.update', $post->id);
        $title = 'Edit';
    }
@endphp
@section('title', $title . ' Blog')
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
                        <h3 class="card-label">{{ $title }} Blog
                        </h3>
                    </div>
                </div>

                <form class="form" method="post" action="{{ $route }}" id="kt_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="status" value="{{ !empty($post) ? $post->status : 'draft' }}" />
                    <input type="hidden" name="post_id" value="{{ !empty($post) ? $post->id : '' }}" />
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Title</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') ?? ($post->title ?? '') }}"/>
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
                                <input type="text" class="form-control" name="meta_title" placeholder="Title" value="{{ old('meta_title') ?? ($post->metas['meta_title'] ?? '') }}"/>
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

                        <div class="add__schedule">
                            @if(isset($post) && $post->scheduled_time)
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Scheduled</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" readonly name="scheduled_time" placeholder="" value="{{ $post->scheduled_time }}"/>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6 d-flex">
                                @if (isset($post) && $post->status === 'draft')
                                    <button type="button" class="mr-2 btn btn-warning" onclick="saveDraft()">Save draft</button>
                                @endif
                                <button type="submit" class="btn btn-success mr-2 btn__change__text">
                                    {{ isset($post) && $post->scheduled_time ? 'Schedule Post' : 'Publish' }}
                                </button>
                                <div class="dropdown">
                                    <button type="button" class="mr-2 btn btn-success dropdown-toggle dropdown-toggle-not-text" data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item item__published choose__status hide {{ isset($post) && $post->scheduled_time ? 'show' : '' }}" data-status="published" href="javascript:void(0)">
                                            Published post
                                        </a>

                                        <a data-toggle="modal" data-target="#schedule__modal" class="dropdown-item item__scheduled choose__status hide show" data-status="scheduled" href="javascript:void(0)">
                                            Schedule post
                                        </a>
                                    </div>
                                  </div>
                                <a href="{{ route('blog.posts.list') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="schedule__modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Schedule Post</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="pwd">Choose Schedule:</label>
                                        <input type="text" class="form-control daterange__picker">
                                      </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="save__schedule" data-dismiss="modal">Save</button>
                                </div>

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
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script    <script type="text/javascript" src="{{ asset('js/handle-csrf-token.js') }}"></script>
>
        FormValidation.formValidation(
            document.getElementById('kt_form'),
            {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Input Title.'
                            },
                        }
                    },
                    slug: {
                        validators: {
                            notEmpty: {
                                message: 'Input Slug.'
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
            toolbar: ['styleselect fontselect fontsizeselect toc',
                'undo redo | cut copy paste | bold italic | forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight',
                'bullist numlist | outdent indent | blockquote subscript  superscript | advlist | autolink | lists charmap | print preview |  code | fullscreen'],
            plugins : 'advlist autolink link image imagetools lists charmap print preview code fullscreen textcolor toc',
            // images_upload_handler: example_image_upload_handler
            /* enable title field in the Image dialog*/
            image_title: true,
            image_caption: true,

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
                alignleft: {selector: 'p,span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'left'}},
                aligncenter: {selector: 'p,span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'center'}},
                alignright: {selector: 'p,span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'right'}},
                alignjustify: {selector: 'p,span,em,i,b,strong', block: 'span', styles: {display: 'block', 'text-align':'full'}}
            },
            force_p_newlines: true,
            forced_root_block : 'p',
            fix_list_elements : true,
            // valid_styles : 'text-align,color,font-size,background-color,font-color,font-family,list-style-type',
            menubar: 'view',
            advlist_bullet_styles: "default,circle,disc,square,hyphen"
        });

        $('#kt_select2_categories').select2({
            placeholder: 'Select Category'
        });

        $('#kt_select2_tags').select2({
            placeholder: 'Select tag',
            tags: true
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

    <script>
        $(function() {
            $('.daterange__picker').daterangepicker({
                timePicker: true,
                minDate: moment(),
                singleDatePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                autoUpdateInput: false,
                locale: {
                    format: 'Y-M-D HH:mm:ss',
                }
            });

            $('.daterange__picker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('Y-M-D HH:mm:ss'));
            });

            $('.daterange__picker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            let getTime = "{{ isset($post) && $post->scheduled_time ? $post->scheduled_time : '' }}";

            $('.daterange__picker').val(getTime);
        });

        $(document).on('click','#save__schedule',function(){
            let time = $('.daterange__picker').val();
            if(time){
                $('.add__schedule').html(`
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Scheduled</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly name="scheduled_time" placeholder="" value="${time}"/>
                        </div>
                    </div>
                `);
                $('.btn__change__text').text('Schedule Post');
                $('.item__published').addClass('show');
                $('[name=status]').val('scheduled');
            }else{
                resetSchedule();
            }
        })

        $(document).on('click','.item__published',function(){
            resetSchedule();
        })

        function resetSchedule(){
            $('.add__schedule').html("");
            $('.btn__change__text').text('Publish');
            $('.item__published').removeClass('show');
            $('[name=status]').val('published');
        }
    </script>
    <script>
        let isChanged = false;
        function onChangeTinymce() {
            isChanged = true;
        }
        function saveDraft() {
            window.onbeforeunload = null
            const form = $('#kt_form')
            form.submit()
        }
        $('#kt_form input, #kt_form select, #kt_form textarea').on('change', function() {
            isChanged = true;
        })
        $('a').on('click mousedown', function(e) {
            let href = $(this).attr('href')
            if (href !== 'javascript:void(0)') {
                if (isChanged) {
                    e.preventDefault()
                    @if (empty($post))
                        swal.fire({
                            title: "Are you sure you want to leave this page?",
                            html: "You have some unsaved changes",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Save as draft",
                            cancelButtonText: "Leave page",
                            showCloseButton: true,
                            reverseButtons: false,
                            allowOutsideClick: false
                        }).then(function (result) {
                            if (result.value) {
                                window.onbeforeunload = null
                                const form = $('#kt_form')
                                form.find('[name=status]').val('draft')
                                form.submit()
                            } else if (result.dismiss === "cancel") {
                                window.onbeforeunload = null
                                window.location.href = href
                            }
                        });
                    @else
                        swal.fire({
                            title: "Are you sure you want to leave this page?",
                            html: "You have some unsaved changes",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Save",
                            cancelButtonText: "Leave page",
                            showCloseButton: true,
                            reverseButtons: false,
                            allowOutsideClick: false
                        }).then(function (result) {
                            if (result.value) {
                                window.onbeforeunload = null
                                const form = $('#kt_form')
                                // form.submit()
                            } else if (result.dismiss === "cancel") {
                                window.onbeforeunload = null
                                window.location.href = href
                            }
                        });
                    @endif
                }
            }

        })

        $('#kt_form [type=submit]').on('click', function() {
            window.onbeforeunload = null
            const form = $('#kt_form')
            const submitBtn = form.find('[type=submit]')
            const status = submitBtn.text().trim()

            if (status == 'Schedule Post') {
                form.find('[name=status]').val('scheduled')
            } else if (status == 'Publish') {
                form.find('[name=status]').val('published')
            }
        })
        window.onbeforeunload = function() {
            if (isChanged) {
                return 'You have unsaved changes! Are you sure ';
            }
        }
        setInterval(() => {
            const form = document.getElementById('kt_form');
            if (isChanged) {
                let dataForm = new FormData(form)
                const content = tinymce.activeEditor.getContent();
                dataForm.append('content', content)
                $.ajax({
                    url: "{{ route('blog.posts.autosave') }}",
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: dataForm,
                    error: function(jqXHR, textStatus, errorThrown) {
                        switch (jqXHR.status) {
                            case 419: refreshCsrfToken()
                            break;
                        }
                    },
                    success: function(data) {
                        if (data.message) {
                            const post = data.message
                            $(form).find('[name=post_id]').val(post.id)
                            $(form).find('[name=status]').val(post.status)
                            $(form).attr('action', '/blog/posts/update/'+post.id)
                        }
                    }
                })
            }
        }, 30*1000)
    </script>
@endsection
