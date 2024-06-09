@extends('layouts.admin')

@section('title')
@lang('Transactions')
@endsection

@section('breadcrumb')
<section class="section">
  <div class="section-header">
    <h1> @lang('Transactions')</h1>
  </div>
</section>

@endsection

@section('content')
<div class="container-xl">
  <div class="row row-deck row-cards">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-end">
          <form action="" class="d-flex flex-wrap justify-content-end">
            <div class="form-group m-1 flex-grow-1">
              <select name="" class="form-control" onChange="window.location.href=this.value">
                <option value="{{filter('remark','')}}">@lang('All Remark')</option>

          

                <option value="{{filter('remark','withdraw_money')}}" {{request('remark')=='withdraw_money' ? 'selected'
                  :''}}>@lang('Withdraw Money')</option>

                <option value="{{filter('remark','bidding')}}" {{request('remark')=='bidding' ? 'selected' :''}}>
                  @lang('Bidding')</option>

                  <option value="{{filter('remark','winning')}}" {{request('remark')=='winning' ? 'selected' :''}}>
                    @lang('Winning')</option>

                <option value="{{filter('remark','refund')}}" {{request('remark')=='refund'
                  ? 'selected' :''}}>@lang('Refund')</option>

                <option value="{{filter('remark','add_balance')}}" {{request('remark')=='add_balance' ? 'selected' :''}}>
                  @lang('Add Balance')</option>

                  <option value="{{filter('remark','subtract_balance')}}" {{request('remark')=='subtract_balance' ? 'selected' :''}}>
                    @lang('Substract Balance')</option>

        

              </select>
            </div>

            <div class="form-group m-1 flex-grow-1">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="@lang('Transaction ID')">
                <div class="input-group-append">
                  <button class="input-group-text btn btn-primary text-white" id="my-addon"><i
                      class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>@lang('Date')</th>
                <th>@lang('User')</th>
                <th>@lang('Transaction ID')</th>
                <th>@lang('Description')</th>
                <th>@lang('Remark')</th>
                <th>@lang('Amount')</th>
                <th>@lang('Charge')</th>
                
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $item)
              <tr>
                <td data-label="@lang('Date')">{{dateFormat($item->created_at,'d-M-Y')}}</td>
                <td>
                  
                  <a href="{{route('admin.user.details',$item->user_id)}}">{{$item->user->name}}</a>
                  
                 
                  
                </td>
                <td data-label="@lang('Transaction ID')">
                  {{__($item->trnx)}}
                </td>
                <td data-label="@lang('Description')">
                  {{__($item->details)}}
                </td>
                <td data-label="@lang('Remark')">
                  <span class="badge badge-dark">{{ucwords(str_replace('_',' ',$item->remark))}}</span>
                </td>
                <td data-label="@lang('Amount')">
                  <span class="{{$item->type == '+' ? 'text-success':'text-danger'}}">{{$item->type}}
                    {{amount($item->amount,$item->currency->type,2)}} {{$item->currency->code}}</span>
                </td>
                <td data-label="@lang('Charge')">
                  {{amount($item->charge,$item->currency->type,2)}} {{$item->currency->code}}
                </td>
               
              </tr>
              @empty
              <tr>
                <td class="text-center" colspan="12">@lang('No data found!')</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        @if ($transactions->hasPages())
        <div class="card-footer">
          {{$transactions->links('admin.partials.paginate')}}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('Withdraw Details')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid withdraw-details">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>

      </div>
    </div>

  </div>
</div>
@endsection

@push('script')

<script>
  $(function(){
            'use strict';

            $('.details').on('click',function(){
                const modal = $('#details');

                let html = `
                
                    <ul class="list-group">
                           
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Transaction Id')
                                <span>${$(this).data('transaction')}</span>
                            </li>  
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('User Name')
                                <span>${$(this).data('provider')}</span>
                            </li> 
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Withdraw Method')
                                <span>${$(this).data('method_name')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Withdraw Date')
                                <span>${$(this).data('date')}</span>
                            </li> 
                        </ul>
                        <hr>
                        <h6>@lang('User Data For Withdraw : ')</h6>
                        <textarea class="form-control" rows="5" disabled>${$(this).data('user_data')}</textarea>
                `;

                modal.find('.withdraw-details').html(html);
                modal.modal('show');
            })
        })
    
    
</script>

@endpush