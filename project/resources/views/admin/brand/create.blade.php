@extends('layouts.admin')
@section('title')
@lang('Add New Brand')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@lang('Add New Brand')</h1>
        <a href="{{route('admin.brand.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i>
            @lang('Back')</a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Brand Form') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{route('admin.brand.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-md-12 ShowImage mb-3  text-center">
                        <img src="{{ getPhoto('no-image.png') }}" class="img-fluid" alt="image" width="400">
                    </div>
                    <div class="form-group">
                        <label for="title">{{ __('Brand Title') }}</label>
                        <input type="text" class="form-control" name="name" id="title" required
                            placeholder="{{ __('brand Title') }}" value="{{old('title')}}">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">{{ __('Brand Photo') }}</label>
                                <span class="ml-3">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select class="form-control  mb-3" name="status" required>
                                    <option value="1">{{__('Active')}}</option>
                                    <option value="0">{{__('Inactive')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                   
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Row-->
@endsection

@push('script')

<script>


</script>

@endpush