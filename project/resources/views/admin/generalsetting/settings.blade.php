@extends('layouts.admin')
@section('title')
    @lang('General Settings')
@endsection
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Site Settings')</h1>
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
               <h6>@lang('Basic Settings')</h6>
            </div>
            <div class="card-body">
              
                <form id="geniusformUpdate" action="{{route('admin.gs.update')}}" enctype="multipart/form-data" method="POST">
                   @csrf
                   <input type="hidden" value="1" name="setting">
                   @include('admin.partials.form-both')
                      
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">{{ __('Website Title') }}</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Website Title') }}" value="{{$gs->title}}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">{{ __('Contact No') }}</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="contact_no" placeholder="{{ __('Contact No') }}" value="{{$gs->contact_no}}">
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="theme_color" class="col-sm-3 col-form-label">{{ __('Theme Color') }}</label>
                        <div class="col-sm-9 input-group cp">
                            <input type="text" class="form-control colorpicker-element" value="{{"#".$gs->theme_color}}" id="theme_color" name="theme_color" placeholder="{{ __('Theme Color') }}" >
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Site Maintainance Mode') }}</label>
                        <div class="col-sm-9">
                            <div class="btn-group mb-1">
                                <button type="button" class="btn dropdown-toggle {{ $gs->is_maintenance == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ $gs->is_maintenance == 1 ? __('Activated') : __('Deactivated') }}
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,is_maintenance')}}">{{ __('Activated') }}</a>
                                    <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,is_maintenance')}}">{{ __('Deactivated') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="form-group row mt-5">
                    <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Google Recaptcha') }}</label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle {{ $gs->recaptcha == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{ $gs->recaptcha == 1 ? __('Activated') : __('Deactivated') }}
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,recaptcha')}}">{{ __('Activated') }}</a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,recaptcha')}}">{{ __('Deactivated') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Google Recaptcha Site Key') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tawk_id" name="recaptcha_key" value="{{$gs->recaptcha_key}}" placeholder="{{ __('Google Recaptcha Key') }}">
                    </div>
                  </div>
                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Google Recaptcha Secret Key') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tawk_id" name="recaptcha_secret" value="{{$gs->recaptcha_secret}}" placeholder="{{ __('Google Recaptcha Secret Key') }}">
                    </div>
                  </div>
                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Frontend Domains') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control "   name="fron_domain" value="{{$gs->fron_domain}}">
                    </div>
                  </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Backend Domains') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"   name="back_domain" value="{{$gs->back_domain}}">
                    </div>
                  </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Copyright Text') }}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="copyright" rows="5">{{$gs->copyright}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row mb-5">
                    <label for="tawk_id" class="col-sm-3 col-form-label">{{ __('Footer Text') }}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="footer_text" rows="5">{{$gs->footer_text}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Register Email Verification') }}</label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle {{ $gs->is_verify == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{ $gs->is_verify == 1 ? __('Activated') : __('Deactivated') }}
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,is_verify')}}">{{ __('Activated') }}</a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,is_verify')}}">{{ __('Deactivated') }}</a>
                            </div>
                        </div>
                    </div>
                </div>       
                        
                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Know Your Customer(KYC)') }}</label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle {{ $gs->kyc == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{ $gs->kyc == 1 ? __('Activated') : __('Deactivated') }}
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,kyc')}}">{{ __('Activated') }}</a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,kyc')}}">{{ __('Deactivated') }}</a>
                            </div>
                        </div>
                    </div>
                </div>       
                  <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Email Notification') }}</label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle {{ $gs->email_notify == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{ $gs->email_notify == 1 ? __('Activated') : __('Deactivated') }}
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,email_notify')}}">{{ __('Activated') }}</a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,email_notify')}}">{{ __('Deactivated') }}</a>
                            </div>
                        </div>
                    </div>
                </div>       
                     
                <div class="form-group row ">
                    <label for="secendary_color" class="col-sm-3 col-form-label">{{ __('Two Step Authentication') }}</label>
                    <div class="col-sm-9">
                        <div class="btn-group mb-1">
                            <button type="button" class="btn dropdown-toggle {{ $gs->two_fa == 1 ? 'btn-success' : 'btn-danger' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{ $gs->two_fa == 1 ? __('Activated') : __('Deactivated') }}
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','1,two_fa')}}">{{ __('Activated') }}</a>
                                <a class="dropdown-item gs-status-check cursor-pointer" data-href="{{route('admin.gs.status','0,two_fa')}}">{{ __('Deactivated') }}</a>
                            </div>
                        </div>
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