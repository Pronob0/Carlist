@extends('layouts.admin')

@section('title')
@lang('Brands')
@endsection

@section('breadcrumb')
<section class="section">
   <div class="section-header">
      <h1>@lang('Brands')</h1>
   </div>
</section>
@endsection

@section('content')


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
            <a href="{{ route('admin.brand.create') }}" type="button" class="btn btn-primary">
               <i class="fas fa-plus"></i> @lang('Add New')
            </a>

         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                  <th>@lang('Image')</th>
                  <th>@lang('Name')</th>
                  <th>@lang('products')</th>
                  <th>@lang('Status')</th>
                  <th class="text-right">@lang('Action')</th>
               </tr>
               @forelse ($brands as $item)
               <tr>

                  <td data-label="{{ __('Photo') }}">
                     <img src="{{ getPhoto($item->image) }}" alt="" width="100">
                  </td>
                  <td data-label="@lang('Name')">
                     {{$item->name}}
                  </td>
                  <td data-label="@lang('Products')">
                     {{'products count here'}}
                  </td>

                  <td data-label="@lang('Status')">
                     @if ($item->status == 1)
                     <span class="badge badge-success"> @lang('Active') </span>
                     @else
                     <span class="badge badge-warning"> @lang('Inactive') </span>
                     @endif
                  </td>
                  <td data-label="@lang('Action')" class="text-right">

                     <a href="{{route('admin.brand.edit',$item->id)}}" class="btn btn-primary approve btn-sm edit mb-1"
                        title="@lang('Edit')"><i class="fas fa-edit"></i></a>

                     <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                        data-href="{{route('admin.brand.destroy',$item->id)}}" data-toggle="tooltip"
                        title="@lang('Remove')"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @empty

               <tr>
                  <td class="text-center" colspan="100%">@lang('No Data Found')</td>
               </tr>

               @endforelse
            </table>
         </div>
      </div>
      <div class="mx-auto">
         @if ($brands->hasPages())
         {{ $brands->links('admin.partials.paginate') }}
         @endif
      </div>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <form action="" method="POST">
         @method('DELETE')
         @csrf
         <input type="hidden" name="id">
         <div class="modal-content">
            <div class="modal-body text-center">
               <h5>@lang('Are you sure to remove?')</h5>
               <p>@lang('Everything will be deleted under this Brand')</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-danger">@lang('Confirm')</button>
            </div>
         </div>
      </form>
   </div>
</div>

@endsection

@push('script')
<script>
   'use strict';
   (function($){
       $('.remove').on('click',function(){
           var href = $(this).data('href');
             var modal = $('#removeMod');
            modal.find('form').attr('action',href);
           modal.modal('show');
       });
   })(jQuery)
</script>

@endpush