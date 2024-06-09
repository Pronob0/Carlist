@extends('layouts.admin')
@section('title')
@lang('Add New CAr')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@lang('Add New Car')</h1>
        <a href="{{route('admin.car.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i>
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
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{route('admin.car.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-md-12 ShowImage mb-3  text-center">
                        <img src="{{ getPhoto('no-image.png') }}" class="img-fluid" alt="image" width="400">
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="title" required
                                    placeholder="{{ __('Title') }}" value="{{old('title')}}">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="categorys">{{ __('Category') }}</label>
                                <select class="form-control  mb-3" id="categorys" name="category_id" required>
                                    <option value="" selected disabled>{{__('Select Category')}}</option>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="categorys">{{ __('Condition') }}</label>
                                <select class="form-control  mb-3" id="conditions" name="condition_id" required>
                                    <option value="" selected disabled>{{__('Select Condition')}}</option>
                                    @foreach ($conditions as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="brand">{{ __('Brand') }}</label>
                                <select class="form-control  mb-3" id="brand" name="brand_id" required>
                                    <option value="" selected disabled>{{__('Select Brand')}}</option>
                                    @foreach ($brands as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="model">{{ __('Model') }}</label>
                                <select class="form-control  mb-3" id="model" name="model_id" required>
                                    <option value="" selected disabled>{{__('Select Model')}}</option>
                                    @foreach ($models as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <labeL for="fuel">{{ __('Fuel Type') }}</labeL>
                                <select class="form-control  mb-3" id="fuel" name="fuel_id" required>
                                    <option value="" selected disabled>{{__('Select Fuel')}}</option>
                                    @foreach ($fuels as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="transmission">{{ __('Transmission') }}</label>
                                <select class="form-control  mb-3" id="transmission" name="transmission_id" required>
                                    <option value="" selected disabled>{{__('Select Transmission')}}</option>
                                    @foreach ($transmissions as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                {{-- mileage   --}}
                                <label for="mileage">{{ __('Mileage KMh') }}</label>
                                <input type="number" class="form-control" name="mileage" id="mileage" required
                                    placeholder="{{ __('Mileage') }}" value="{{old('mileage')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">{{ __('Current Price') }}</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="current_price" id="price"
                                    required placeholder="{{ __('Current Price in ') }}{{ showCurrency() }}"
                                    value="{{old('price')}}">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bid_inc">{{ __('Previous Price') }}</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="previous_price" id="bid_inc"
                                    required placeholder="{{ __('Previous Price ') }}{{ showCurrency() }}"
                                    value="{{old('bid_inc')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">{{ __('Feature Photo') }}</label>
                                <span class="ml-3">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image"
                                        accept="image/*" required>
                                    <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Is Featured') }}</label>
                                <select id="schedule" class="form-control  mb-3" name="is_feature" required>
                                    <option value="1">{{__('Yes')}}</option>
                                    <option value="0">{{__('NO')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{ __('Status') }}</label>
                            <select class="form-control  mb-3" name="status" required>
                                <option value="1">{{__('Active')}}</option>
                                <option value="0">{{__('Pending')}}</option>
                                <option value="2">{{__('Rejected')}}</option>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tag">{{ __('Tags') }}</label>
                            <input type="text" class="form-control tagify__input" id="tag" name="tags" value="{{old('tags')}}"
                                placeholder="{{ __('Tags') }}">
                        </div>

                    </div>


                    <div class="form-group col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea id="area1" class="form-control summernote" name="description"
                            placeholder="{{ __('Description') }}">{{old('description')}}</textarea>
                    </div>

                    <div class="video mb-3">
                        <h4> @lang('Upload Video') </h4>
                    </div>

                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('upload video 1 thumbnail') }}</label>
                                <input type="file" class="form-control" name="video_image1" id="video_image1"
                                    accept="image/*" required> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('upload video 2 thumbnail') }}</label>
                                <input type="file" class="form-control" name="video_image2" id="video_image2"
                                    accept="image/*" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_link1">{{ __('video 1 link ') }}</label>
                                <input type="text" class="form-control" name="video_link1" id="video_link1" required
                                    placeholder="{{ __('video link 1') }}" value="{{old('video_link1')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_link2">{{ __('video 2 link') }}</label>
                                <input type="text" class="form-control" name="video_link2" id="video_link2" required
                                    placeholder="{{ __('video link 2') }}" value="{{old('video_link2')}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border border-primary">
                                <div class="d-flex justify-content-between bg-primary  p-3">
                                    <h5 class="card-title text-white">{{ __('Upload gallery Images') }}</h5>
                                    <div class="upload__box">
                                        <div class="upload__btn-box">
                                            <label class="upload__btn">
                                                <p>@lang('Upload images')</p>
                                                <input type="file" multiple="" name="gallery[]" data-max_length="20"
                                                    class="upload__inputfile">
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body" id="multi-image">
                                    <div class="upload__img-wrap"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border border-primary">
                                <div class="d-flex justify-content-between bg-primary  p-3">
                                    <h5 class="card-title text-white">{{ __('Specification') }}</h5>
                                    <button type="button" class="btn btn-sm btn-outline-dark text-white addnew"> <i
                                            class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}</button>
                                </div>
                                <div class="card-body">
                                    <div class="addfield">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- meta tags and meta description  --}}
                    <div class="form-group">
                        <label for="meta_tags">{{ __('Meta Tags') }}</label>
                        <input type="text" class="form-control tagify__input" id="meta_tags" name="meta_tag"
                            value="{{old('meta_tags')}}" placeholder="{{ __('Meta Tags') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta_description">{{ __('Meta Description') }}</label>
                        <textarea id="meta_description" class="form-control" name="meta_description"
                            placeholder="{{ __('Meta Description') }}">{{old('meta_description')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
        <!-- Form Sizing -->
        <!-- Horizontal Form -->
    </div>
</div>
<!--Row-->
@endsection

@push('script')

<script>
    'use strict';

    $('input[name=tags]').tagify();

    $('input[name=meta_tag]').tagify();
    

    $('.addnew').on('click', function() {
       
        var html = '<div class="user-data row"><div class="col-md-4 mb-3"><input type="text" class="form-control" name="specification_name[]" id="specification_name" required placeholder="{{ __('Specification Name') }}" value="{{old('specification_name')}}"></div><div class="col-md-6 mb-3"><input type="text" class="form-control" name="specification_value[]" id="specification_value" required placeholder="{{ __('Specification Value') }}" value="{{old('specification_value')}}"></div><div class="col-md-2 mb-3"><button type="button" class="btn  btn-danger remove w-100"> <i class="fa fa-times" aria-hidden="true"></i></button></div></div>';

        $('.addfield').append(html);
 
    });

    $('.addfield').on('click', '.remove', function() {
        $(this).closest('.user-data').remove();
    });


</script>

@endpush