@extends('layouts.admin')

@section('title')
@lang('All Cars')
@endsection

@section('breadcrumb')
<section class="section">
   <div class="section-header">
      <h1 id="title">Publish Cars</h1>
   </div>
</section>
@endsection

@section('content')


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                  <th>@lang('Image')</th>
                  <th>@lang('Title')</th>
                  <th>@lang('Owner')</th>
                  <th>@lang('Brand')</th>
                  <th>@lang('Model')</th>
                  <th>@lang('Status')</th>
                  <th class="text-right">@lang('Action')</th>
               </tr>
               @if(count($cars) < 1) <tr>
                  <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                  </tr>
                  @else
                  @foreach ($cars as $item)
                  <tr>

                     <td data-label="{{ __('Photo') }}">
                        <img class="mt-2" src="{{ getPhoto($item->image) }}" alt="" width="100">
                     </td>
                     <td data-label="@lang('Title')">
                        {{$item->title}}
                     </td>

                     <td data-label="@lang('Owner')">
                        {{$item->user_id == 0 ? 'Admin' : $item->user->username}}
                     </td>

                     <td data-label="@lang('Brand')">
                        {{$item->brand->name}}
                       
                     </td>

                     <td data-label="@lang('Model')">
                        {{$item->model->name}}
                     </td>

                     <td data-label="@lang('Status')">
                        @if($item->status == 1)
                        <span class="badge badge-success">@lang('Published')</span>
                        @elseif($item->status == 0)
                        <span class="badge badge-warning">@lang('Pending')</span>
                        @elseif($item->status == 2)
                        <span class="badge badge-danger">@lang('Rejected')</span>
                        @endif
                        
                     </td>

                     <td data-label="@lang('Action')" class="text-right">
                        <a href="{{route('admin.car.edit',$item->id)}}"
                           class="btn btn-primary approve btn-sm edit mb-1" title="@lang('Edit')"><i
                              class="fas fa-edit"></i></a>

                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                           data-href="{{route('admin.car.destroy')}}" data-id="{{ $item->id }}"
                           data-toggle="tooltip" title="@lang('Remove')"><i class="fas fa-trash"></i></a>
                     </td>
                  </tr>
                  @endforeach
                  @endif

            </table>
         </div>

         <div class="mx-auto">
            @if ($cars->hasPages())
            {{ $cars->links('admin.partials.paginate') }}
            @endif
         </div>

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
               <p>@lang('Everything will be deleted under this Category')</p>
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
            var modal = $('#removeMod');
            modal.find('form').attr('action',$(this).data('href'))
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
         });

         // ready function 
         $(document).ready(function(){
            var title = $('.ttl').val();
            $('#title').text(title);
            
         })
   })(jQuery)
 
</script>

@endpush