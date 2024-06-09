@extends('layouts.admin')
@section('title')
    @lang('General Settings')
@endsection
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Charge Setting')</h1>
        </div>
</section>
@endsection
@section('title')
   @lang('General Settings')
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
               <h6>@lang('Charge Settings')</h6>
            </div>
            <div class="card-body">
              
                <form id="geniusformUpdate" action="{{route('admin.gs.charge.update')}}" enctype="multipart/form-data" method="POST">
                   @csrf
                   <input type="hidden" value="1" name="setting">
                   @include('admin.partials.form-both')
                    

                    <div class="form-group row mt-5">
                        <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Charge Type') }}</label>
                        <div class="col-sm-9">
                                <select id="my-select" class="form-control" name="charge_type">
                                    <option value="1" {{ $gs->charge_type == 'parcent' ? 'selected' : '' }}>@lang('Percentage')</option>
                                    <option value="2" {{ $gs->charge_type == 'fixed' ? 'selected' : '' }}>@lang('Fixed Amount')</option>
                                </select>
                        </div>
                    </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Amount') }}</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="tawk_id" min="0" name="charge_amount" value="{{$gs->charge_amount}}" placeholder="{{ __('Charge Amount') }}">
                    </div>
                  </div>
                 
      
                   <div class="form-group row">
                      <div class="col-12 text-right">
                         <button type="submit" class="btn btn-primary">{{__('Update Settings')}}</button>
                      </div>
                   </div>
                </form>
             </div>
        </div>

    </div>
</div>



@endsection

@push('script')
    <script>
        'use strict';
        $('input[name=allowed_email]').tagify();
    </script>
@endpush