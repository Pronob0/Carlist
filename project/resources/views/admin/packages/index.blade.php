@extends('layouts.admin')

@section('title')
   @lang('Manage Packages')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('Manage Packages')</h1>
    </div>
</section>
@endsection
@section('content')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
	<div class="card mb-4">
    <div class="card-header d-flex justify-content-end">
      <a href="{{route('admin.package.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('Add New')</a>
    </div>
	  <div class="table-responsive p-3">
      <table class="table align-items-center table-striped">

          <tr>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Cost') }}</th>
            <th>{{ __('Term') }}</th>
            <th>{{ __('Number of car add') }}</th>
            <th>{{ __('Number of car featured') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
          </tr>
  
 
          @forelse ($packages as $item)
          <tr class="">
               <td data-label="{{ __('Title') }}">
                 {{$item->title}}
               </td>
               <td data-label="{{ __('Cost') }}">
                 {{$item->price}}
               </td>
                <td data-label="{{ __('Term') }}">
                    @if ($item->term == 'monthly')
                    <span class="badge badge-primary"> @lang('Monthly') </span>
                    @elseif($item->term == 'yearly')
                    <span class="badge badge-info"> @lang('Yearly') </span>
                    @else
                    <span class="badge badge-success"> @lang('Lifetime') </span>
                    @endif
                </td>
                <td data-label="{{ __('Number of car add') }}">
                  {{$item->number_of_car_add}}
                </td>
                <td data-label="{{ __('Number of car featured') }}">
                  {{$item->number_of_car_featured}}
                </td>
               <td data-label="{{ __('Status') }}">
                  @if ($item->status == 1)
                  <span class="badge badge-success"> @lang('Active') </span>
                  @else
                  <span class="badge badge-warning"> @lang('Inactive') </span>
                  @endif
               </td>

               <td data-label="{{ __('Action') }}">
                  <a href="{{route('admin.package.edit',$item->id)}}" class="btn btn-primary  btn-sm edit mb-1" data-toggle="tooltip" title="@lang('Edit')"><i class="fas fa-edit"></i></a>

                  <a href="javascript:void(0)" class="btn btn-danger  btn-sm remove mb-1" data-route="{{route('admin.package.destroy',$item)}}" data-toggle="tooltip" title="@lang('Delete')"><i class="fas fa-trash"></i></a>
                  
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
  <!-- DataTable with Hover -->

</div>
<!--Row-->

<div class="mx-auto">
  @if ($packages->hasPages())
  {{ $packages->links('admin.partials.paginate') }}
  @endif
</div>



<!-- Modal -->
<div class="modal fade" id="del" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="" method="post">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="mt-3">@lang('Are you sure to remove?')</h5>
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
      $('.remove').on('click',function () { 
        var route = $(this).data('route')
        $('#del').find('form').attr('action',route)
        $('#del').modal('show')
      })
    </script>
@endpush
