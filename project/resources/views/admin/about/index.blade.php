@extends('layouts.admin')

@section('title')
@lang('About Us')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang('About Us')</h1>
        <a href="{{route('admin.frontend.index')}}" class="btn btn-primary"><i class="fa fa-backward"></i>
            @lang('Back')</a>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('About Us Content')</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="row justify-content-center m-auto">
                            <div class="form-group col-md-8">
                                <label for="">@lang('Image One')</label>
                                <div class="gallery gallery-fw" data-item-height="300">
                                    <img class="gallery-item imageShow"
                                        data-image="{{getPhoto($about->image)}}">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input imageUpload mb-2"
                                        id="customFile">
                                    <code class="text-danger">@lang('Image size : 960 px x 800 px')</code>
                                    <input type="hidden" name="image_size" value="960x800">
                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="">@lang('Heading')</label>
                            <input type="text" name="title" class="form-control" placeholder="@lang('Heading')"
                                value="{{ $about->title }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">@lang('Sub Heading')</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="@lang('Sub Heading')" value="{{ $about->subtitle }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('Video Link')</label>
                            <input type="text" name="video_link" class="form-control" placeholder="@lang('Video Link')"
                                value="{{ $about->video_link }}" required>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>@lang('About Table')</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>
                    @lang('Add New')</button>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Icon Image')</th>
                            <th>@lang('Title')</th>
                            <th>@lang('subtitle')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        
                        @forelse ($tables as $key => $info)
                        <tr>
                            <td data-label="@lang('Icon Image')">
                                <img src="{{getPhoto($info->image)}}" width="50px">
                            </td>
                            <td data-label="@lang('Title')">{{$info->title}}</td>
                            <td data-label="@lang('Subtitle')">{{ $info->subtitle }}</td>
                            <td data-label="@lang('Action')">
                                <div
                                    class="d-flex flex-wrap flex-lg-nowrap align-items-center justify-content-end justify-content-lg-center">
                                    <a href="javascript:void(0)" class="btn btn-primary details btn-sm m-1"
                                        data-key="{{$key}}" data-item="{{$info}}"
                                        data-img="{{getPhoto($info->image)}}"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:void(0)" class="btn btn-danger remove btn-sm m-1"
                                        data-key="{{$info->id}}"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                        </tr>

                        @endforelse
                       
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.about.table') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="col-form-label">@lang('Icon Image') <code
                            class="text-danger">(@lang('Image size : 270 x 254px'))</code></label>
                    <div class="form-group d-flex justify-content-center">
                        <div id="image-preview" class="image-preview image-preview_alt" style="background-image:url();">
                            <label for="image-upload" id="image-label">@lang('Choose File')</label>
                            <input type="file" name="image" id="image-upload" />
                            <input type="hidden" name="image_size" value="270x254" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label>@lang('Title')</label>
                        <input class="form-control" type="text" name="title" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('Subtitle')</label>
                        <textarea class="form-control" name="subtitle" required></textarea>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.about.table.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
        
            <input type="hidden" name="sub_key">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Sub Content')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="col-form-label">@lang('Icon Image') <code
                            class="text-danger">(@lang('Image size : 128 x 128px'))</code></label>
                    <div class="form-group  d-flex justify-content-center">
                        <div id="image-preview1" class="image-preview image-preview_alt"
                            style="background-image:url();">
                            <label for="image-upload1" id="image-label1">@lang('Choose File')</label>
                            <input type="file" name="image" id="image-upload1" />
                            <input type="hidden" name="image_size" value="128x128" />
                        </div>

                    </div>

                    <input type="hidden" id="id" name="id" value="">

                    <div class="form-group">
                        <label>@lang('Title')</label>
                        <input class="form-control" type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Subtitle')</label>
                        <textarea name="subtitle" id="" class="form-control"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="remove" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.about.table.delete') }}" method="POST">
            @csrf
            <input type="hidden" name="key">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="mt-3">@lang('Are you sure to remove?')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-danger">@lang('Confirm')</button>
                </div>
            </div>
        </form>
    </div>
</div>




@endsection

@push('script')
<script>
    'use strict';
        
        $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{__('Choose File')}}", // Default: Choose File
                label_selected: "{{__('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1", // Default: .image-label
                label_default: "{{__('Choose File')}}", // Default: Choose File
                label_selected: "{{__('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            function imageShow(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.form-group').find('.imageShow').attr('src',e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").on('change', function () {
            imageShow(this);
        });

        $('.details').on('click',function () { 
            var data = $(this).data('item')
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('textarea[name=subtitle]').val(data.subtitle)
            $('#edit').find('input[name=id]').val(data.id)
            $('#edit').find('#image-preview1').css('background-image','url('+$(this).data('img')+')')
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
</script>
@endpush