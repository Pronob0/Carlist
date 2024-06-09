@extends('layouts.admin')

@section('title')
   @lang('Categories')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('Categories')</h1>
    </div>
</section>
@endsection

@section('content')


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
               <i class="fas fa-plus"></i> @lang('Add New')
             </button>

         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                   <th>@lang('Name')</th>
                   <th>@lang('Slug')</th>
                   <th>@lang('Status')</th>
                   <th class="text-right">@lang('Action')</th>
               </tr>
               @forelse ($categories as $item)
                   <tr>

                        <td data-label="@lang('Name')">
                          {{$item->name}}
                        </td>
                        <td data-label="@lang('Slug')">
                          {{$item->slug}}
                        </td>
                      
                        <td data-label="@lang('Status')">
                           @if ($item->status == 1)
                           <span class="badge badge-success"> @lang('Active') </span>
                           @else
                           <span class="badge badge-warning"> @lang('Inactive') </span>
                           @endif
                        </td>
                        <td data-label="@lang('Action')" class="text-right">
                           <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1" data-route="{{route('admin.category.update',$item->id)}}" data-item="{{$item}}"  data-toggle="tooltip" title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                           <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1" data-id="{{$item->id}}"  data-toggle="tooltip" title="@lang('Remove')"><i class="fas fa-trash"></i></a>
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
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@lang('Add new category')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">

               <div class="form-group">
                  <label>@lang('Name')</label>
                  <input class="form-control" type="text" name="name">
               </div>

               <div class="form-group">
                  <label>@lang('Status')</label>
                  <select name="status" class="form-control">
                     <option value="1">@lang('Active')</option>
                     <option value="0">@lang('Inactive')</option>
                  </select>
               </div>


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>
         </div>
      </form>
   </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@lang('Edit category')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">

               <div class="form-group">
                  <label>@lang('Name')</label>
                  <input class="form-control" type="text" name="name">
               </div>
               <div class="form-group">
                  <label>@lang('Status')</label>
                  <select name="status" class="form-control">
                     <option value="1">@lang('Active')</option>
                     <option value="0">@lang('Inactive')</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>
         </div>
      </form>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.category.destroy')}}" method="POST">
         @method('DELETE')
         @csrf
         <input type="hidden" name="id">
         <div class="modal-content">
            <div class="modal-body">
               <h5>@lang('Are you sure to remove?')</h5>
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
       $('.edit').on('click',function () { 
          var data = $(this).data('item')
          var photo = $(this).data('photo')
          $('#edit').find('input[name=name]').val(data.name)
          $('#edit').find('select[name=status]').val(data.status)
          $('#edit').find('form').attr('action',$(this).data('route'))
          $('#edit').modal('show')
       })

       $('.remove').on('click',function () { 
         $('#removeMod').find('input[name=id]').val($(this).data('id'))
         $('#removeMod').modal('show')
       })

      
    </script>
@endpush

