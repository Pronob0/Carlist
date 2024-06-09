@extends('layouts.admin')

@section('title')
@lang('Manage User')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header justify-content-between">
        <h1> @lang('Manage User')</h1>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="" onChange="window.location.href=this.value">
                        <option value="{{url('admin/manage-users')}}" {{request('status')=='all' ?'selected':''}}>
                            @lang('All')</option>
                        <option value="{{url('admin/manage-users/'.'?status=active')}}" {{request('status')=='active'
                            ?'selected':''}}>@lang('Active')</option>
                        <option value="{{url('admin/manage-users/'.'?status=banned')}}" {{request('status')=='banned'
                            ?'selected':''}}>@lang('Banned')</option>
                        <option value="{{url('admin/manage-users/'.'?status=email_verified')}}"
                            {{request('status')=='email_verified' ?'selected':''}}>@lang('Email Unverified')</option>
                        <option value="{{url('admin/manage-users/'.'?status=kyc_verified')}}"
                            {{request('status')=='kyc_verified' ?'selected':''}}>@lang('KYC Unverified')</option>

                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group has_append ">
                        <input type="text" class="form-control" placeholder="@lang('email')" name="search"
                            value="{{$search ?? ''}}" />
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary border-0"><i
                                    class="fas fa-search text-white"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <a href="{{route('admin.user.create')}}" class="btn btn-primary mb-1 my-2 mr-3"><i class="fas fa-plus"></i>
            @lang('Add New')</a>
    </div>
</section>
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Sl')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Country')</th>
                            <th>@lang('Email Verified')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        @forelse ($users as $key => $user)
                        <tr>
                            <td data-label="@lang('Sl')">{{$key + $users->firstItem()}}</td>

                            <td data-label="@lang('Name')">
                                {{$user->name}}
                            </td>
                            <td data-label="@lang('Email')">{{$user->email}}</td>
                            <td data-label="@lang('Country')">{{$user->country}}</td>
                            <td data-label="@lang('Email Verified')">
                                @if($user->email_verified == 1)
                                <span class="badge badge-success">@lang('YES')</span>
                                @elseif($user->email_verified == 0)
                                <span class="badge badge-danger">@lang('NO')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Status')">
                                @if($user->status == 1)
                                <span class="badge badge-success">@lang('active')</span>
                                @elseif($user->status == 0)
                                <span class="badge badge-danger">@lang('banned')</span>
                                @endif
                            </td>
                            @if (access('edit user'))
                            <td data-label="@lang('Action')">
                                <a class="btn btn-primary details"
                                    href="{{route('admin.user.details',$user->id)}}">@lang('Details')</a>

                                {{-- delete --}}
                                <a href="javascript:void(0)" class="btn btn-danger remove mb-1"
                                    data-route="{{route('admin.user.destroy',$user)}}" data-toggle="tooltip"
                                    title="@lang('Delete')"><i class="fas fa-trash"></i></a>
                            </td>
                            @else
                           
                            @endif
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
                @if ($users->hasPages())
                {{ $users->links('admin.partials.paginate') }}
                @endif

            </div>

            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="mt-3">@lang('Are you sure to remove?')</h5>
                                <p>@lang('If you remove this data then related all data will be removed')</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                                <button type="submit" class="btn btn-danger">@lang('Confirm')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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