@extends('layouts.admin')
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Homepage Settings')</h1>
        </div>
</section>
@endsection
@section('title')
   @lang('Site Logo and Favicon')
@endsection
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> @lang('Homepage 1')</h6>
            </div>
            <div class="card-body">
                {{-- full image show here --}}
                <div class="homepage1 text-center">
                    <img src="{{ getPhoto('HomePage1.png') }}" alt="homepage1" class="w-50">
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-12 text-center">
                      <a href="{{ route('admin.home.status',1) }}" class="btn {{ $gs->homepage == 1 ? 'btn-success' : 'btn-primary' }} btn-block">{{ $gs->homepage == 1 ? 'Active' : 'Set as Active' }}</a>
                    </div>
                  </div>

              
            </div>
        </div>
    </div>

   
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Homepage 2') }}</h6>
        </div>
        <div class="card-body">
            <div class="homepage1 text-center">
                <img src="{{ getPhoto('HomePage2.png') }}" alt="homepage2" class="w-50">
            </div>

            <div class="form-group row mt-3">
                <div class="col-sm-12 text-center">
                  <a href="{{ route('admin.home.status',2) }}" class="btn {{ $gs->homepage == 2 ? 'btn-success' : 'btn-primary' }} btn-block">{{ $gs->homepage == 2 ? 'Active' : 'Set as Active' }}</a>
                </div>
            </div>
            
        </div>
      </div>
    </div>
</div>



@endsection

@push('script')
    <script>
      
    </script>
@endpush