@extends('layouts.admin')

@section('title')
   @lang('Edit Packages')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang('Edit Packages')</h1>
        <a href="{{route('admin.package.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-backward"></i> @lang('Back')</a>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">

    <div class="col-md-8">
       <div class="card">
            <div class="card-body">
                @include('admin.partials.form-both')
                <form action="{{ route('admin.package.update', $package->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>@lang('Package Title')</label>
                            <input class="form-control" type="text" name="title" required value="{{$package->title}}">
                        </div>

                        <div class="form-group col-md-12">
                            <label>@lang('Price in USD')</label>
                            <input class="form-control" type="number" min="0" step="0.01"  name="price" required value="{{$package->price}}">
                        </div>

                        {{-- Term  --}}
                        <div class="form-group col-md-12">
                            <label>@lang('Package Term')</label>
                            <select name="term" id="" class="form-control" required>
                                <option {{ $package->term == 'monthly' ? 'selected' : '' }} value="monthly">@lang('Monthly')</option>
                                <option {{ $package->term == 'yearly' ? 'selected' : '' }} value="yearly">@lang('Yearly')</option>
                                <option {{ $package->term == 'lifetime' ? 'selected' : '' }} value="lifetime">@lang('Lifetime')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('How many cars can the vendor add *')</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="number_of_car_add" required value="{{$package->number_of_car_add}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('How many cars does the vendor make featured *')</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="number_of_car_featured" required value="{{$package->number_of_car_featured}}">
                        </div>
                            
                        <div class="form-group col-md-12">
                            <label>@lang('Status') </label>
                            <select class="form-control" name="status" required>
                                <option value="" >--@lang('Select')--</option>
                                <option {{ $package->status == 1 ? 'selected': '' }}  value="1">@lang('Active')</option>
                                <option {{ $package->status == 0 ? 'selected': ''  }} value="0">@lang('Inactive')</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group text-right col-md-12">
                        <button class="btn  btn-primary btn-lg" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>
@endsection