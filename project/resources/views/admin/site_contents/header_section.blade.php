@extends('layouts.admin')
@section('title')
   @lang('Homepage Header Section')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang('Update Headers')</h1>
        <a href="{{route('admin.dashboard')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back') </a>
    </div>
</section>
@endsection

@section('content')
<p class="text-center text-danger">@lang('** Rest of the Section headers in site content **') </p>

<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card mb-4">
         <div class="card-body">
          
            <form action="{{route('admin.header.section.update')}}" method="POST" enctype="multipart/form-data">
               @csrf
              
            <div class="form-group">
                  <label for="inp-name">{{ __('Featured Header Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="featured_title"  placeholder="{{ __('Enter Featured Header Title') }}" value="{{$header->featured_title}}" required>
            </div>
            <div class="form-group">
                  <label for="inp-name">{{ __('Featured Header Subtitle') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="featured_subtitle"  placeholder="{{ __('Enter Featured Header Subtitle') }}" value="{{$header->featured_subtitle}}" required>
            </div>
            <br>
        
            <div class="form-group">
                  <label for="inp-name">{{ __('Recent Cars Header Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="recentcars_title"  placeholder="{{ __('Enter Recent Cars Header Title') }}" value="{{$header->recentcars_title}}" required>
            </div>

            <div class="form-group">
                  <label for="inp-name">{{ __('Recent Cars Header Subtitle') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="recentcars_subtitle"  placeholder="{{ __('Enter Recent Cars Header Subtitle') }}" value="{{$header->recentcars_subtitle}}" required>
            </div>

            {{-- blog section  --}}
            <div class="form-group">
                  <label for="inp-name">{{ __('Blog Header Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="blog_title"  placeholder="{{ __('Enter Blog Header Title') }}" value="{{$header->blog_title}}" required>
            </div>

            <div class="form-group">
                  <label for="inp-name">{{ __('Blog Header Subtitle') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="blog_subtitle"  placeholder="{{ __('Enter Blog Header Subtitle') }}" value="{{$header->blog_subtitle}}" required>
            </div>


            <br>

               <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection