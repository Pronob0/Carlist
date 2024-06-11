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

	  <div class="table-responsive p-3">
      <table class="table align-items-center table-striped">

          <tr>
            <th>{{ __('Plan Title') }}</th>
            <th>{{ __('User email') }}</th>
            <th>{{ __('amount') }}</th>
            <th>{{ __('currency') }}</th>
            <th>{{ __('Payment Method') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
          </tr>
  
 
          @forelse ($userPackages as $item)
          <tr class="">
                <td data-label="{{ __('Plan Title') }}">
                    {{$item->package->name}}
                </td>

                <td data-label="{{ __('User email') }}">
                    {{$item->user->email}}
                </td>

                <td data-label="{{ __('amount') }}">
                    {{$item->amount}}
                </td>

                <td data-label="{{ __('currency') }}">
                    {{$item->currency}}
                </td>

                <td data-label="{{ __('Payment Method') }}">
                    {{$item->payment_method}}
                </td>

                <td data-label="{{ __('Status') }}">
                    {{-- dropdown --}}
                    <div class="btn-group">
                        <button type="button" class="btn btn-{{ $item->status == 1 ? 'success' : 'danger' }} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.user.package.status', [$item->id, 1]) }}">@lang('Active')</a>
                            <a class="dropdown-item" href="{{ route('admin.user.package.status', [$item->id, 0]) }}">@lang('Inactive')</a>
                        </div>
                    </div>
                </td>

             

               <td data-label="{{ __('Action') }}">
                  <a href="{{route('admin.package.edit',$item->id)}}" class="btn btn-primary  btn-sm edit mb-1" data-toggle="tooltip" title="@lang('Edit')"><i class="fas fa-eye"></i></a>

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
  @if ($userPackages->hasPages())
  {{ $userPackages->links('admin.partials.paginate') }}
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
