@extends('layouts.admin')
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Breadcumb Settings')</h1>
        </div>
</section>
@endsection
@section('title')
   @lang('Site Breadcumb Settings')
@endsection
@section('content')
<form id="geniusformUpdate" action="{{ route('admin.gs.update') }}" enctype="text/plain" method="POST">
  @csrf
<div class="row">
  
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> @lang('Breadcumb Image one')</h6>
            </div>
            <div class="card-body">
              
               @php
                $banner = json_decode($gs->breadcumb_banner);
               @endphp
              
              
                 <div class="form-group d-flex justify-content-center">
                    <div id="image-preview" class="image-preview image-preview_alt"
                        style="background-image:url({{ getPhoto($banner->banner1) }});">
                        <label for="image-upload" id="image-label">@lang('Choose File')</label>
                        <input type="file" name="breadcumb_banner1" id="image-upload" />
                    </div>
                 </div>
                   
              
            </div>
        </div>
    </div>


    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Breadcumb Image two') }}</h6>
        </div>
        <div class="card-body">
           
              
              <div class="form-group d-flex justify-content-center">
                <div id="image-preview1" class="image-preview image-preview_alt"
                    style="background-image:url({{ getPhoto($banner->banner2) }});">
                    <label for="image-upload1" id="image-label">@lang('Choose File')</label>
                    <input type="file" name="breadcumb_banner2" id="image-upload1" />
                </div>
             </div>
            
          
        </div>
      </div>
    </div>

    <div class="form-group row w-100">
      <div class="col-lg-12 text-center">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
      </div>
    </div>
  
</div>

</form>

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
        
    </script>
@endpush