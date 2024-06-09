@extends('layouts.admin')

@section('title')
   @lang('Currency')
@endsection

@push('style')
    <style>
        .default{
          background-color: #3a4bcd26!important;
        }
    </style>
@endpush

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto">@lang('Manage Currency')</h1>
      <div class="d-flex flex-wrap ">

            

            @if (access('add currency'))
            <a href="{{route('admin.currency.add')}}" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> @lang('Add New')</a>
            @endif
            <form action="">
              <div class="input-group has_append">
                <input type="text" class="form-control" placeholder="@lang('Currency Name/Code')" name="search" value="{{$search ?? ''}}"/>
                <div class="input-group-append">
                    <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                </div>
              </div>
            </form>

          </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @foreach ($currencies as $curr)
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="d-flex justify-content-between card-header {{$curr->default == 1 ? 'default' : ''}}">
          <h4><i class="fas fa-coins"></i> {{$curr->curr_name}}</h4>
          @if (access('delete currency'))
          <a href="javascript:void(0)" data-id="{{ $curr->id }}" data-toggle="modal" data-target="#currency_api" class="btn btn-danger mb-1 mr-3"><i class="fas fa-trash"></i> </a>
          @endif
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">@lang('Currency Symbol :')
              <span class="font-weight-bold">{{$curr->symbol}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@lang('Currency Code :')
              <span class="font-weight-bold">{{$curr->code}}</span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">@lang('Rate 1 USD :')
              <span class="font-weight-bold">{{amount($curr->rate,$curr->type,3)}} {{$curr->code}}</span>
            </li>
          </ul>
          @if (access('edit currency'))
      
            <a href="{{route('admin.currency.edit',$curr->id)}}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> @lang('Edit Currency')</a>

          @endif
        </div>
      </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="currency_api" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
     <form action="{{route('admin.currency.delete')}}" method="POST">
      @csrf
      @method('DELETE')
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">@lang('Delete Currency')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              <div class="modal-body">

                <input type="hidden" name="id" id="id" value="">
                 
                <div class="body-delete text-center">
                  <h5 class="mt-3">@lang('Are you sure to remove?')</h5>
                </div>
                
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                  <button type="submit" class="btn btn-danger">@lang('Delete')</button>
              </div>
          </div>
     </form>
  </div>
</div>
@endsection



@push('script')
    <script>
      'use strict';
      $('#currency_api').on('show.bs.modal',function (e) { 
        var id = $(e.relatedTarget).data('id')
        $('#id').val(id)
      })
    </script>
@endpush