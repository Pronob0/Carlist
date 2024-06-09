@extends('layouts.admin')
@section('title')
   @lang('Edit Page')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang('Edit Page')</h1>
        <a href="{{route('admin.page.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back') </a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card mb-4">
         <div class="card-body">
            <form action="{{route('admin.page.update',$page->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               
               <div class="form-group">
                  <label for="inp-name">{{ __('Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="title"  placeholder="{{ __('Enter Title') }}" value="{{$page->title}}" required>
               </div>
               <div class="form-group">
                  <label for="description">{{ __('Description') }}</label>
                  <textarea id="area1" class="form-control summernote" name="details" placeholder="{{ __('Description') }}">{{$page->details}}</textarea>
              </div>

              @if($page->id == 13)

               <div class="col-md-12 ShowImage mb-3  text-center">
                  <img src="{{ getPhoto($page->image) }}" class="img-fluid" alt="image" width="400">
               </div>

               <div class="form-group">
                  <label for="inp-name">{{ __('Header Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="header_title"  placeholder="{{ __('Enter Header Title') }}" value="{{$page->header_title}}" required>
               </div>

               <div class="form-group">
                  <label for="inp-name">{{ __('Header Subtitle') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="header_subtitle"  placeholder="{{ __('Enter Header Subtitle') }}" value="{{$page->header_subtitle}}" required>
               </div>


               <div class="form-group">
                  <label for="inp-name">{{ __('Video link') }}</label>
                  <input type="url" class="form-control" id="inp-name" name="video"  placeholder="{{ __('Enter Video URL') }}" value="{{$page->video}}" required>
               </div>

               <div class="form-group">
                  <label for="image">{{ __('Page Photo') }}</label>
                  <span class="ml-3">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="image" accept="image/*">
                      <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                  </div>
              </div>

              @endif
               <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection