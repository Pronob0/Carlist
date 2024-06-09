<?php

namespace App\Providers;


use App\Models\User;
use App\Models\Escrow;
use App\Models\Deposit;
use App\Models\FundRequest;
use App\Models\SiteContent;
use App\Models\Withdrawals;
use App\Models\RequestMoney;
use App\Models\SupportTicket;
use App\Models\Generalsetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('*',function($settings){
            $settings->with('gs', Generalsetting::first());

        });

        view()->composer('admin.partials.sidebar', function ($view) {
            $view->with([
                
                'pending_user_kyc'        =>  User::whereStatus(1)->where('kyc_status',2)->count(),
                'pending_withdraw'        =>  Withdrawals::whereStatus(0)->count(),
                'pending_user_ticket'     =>  SupportTicket::whereStatus(0)->whereHas('messages')->count(),
                'pending_deposits'        =>  Deposit::count(),
                
            ]);
        });
       
        view()->composer(['frontend.partials.header','frontend.contact','user.invoice.invoice','user.invoice.view'], function ($view) {
            $view->with([
                'contact'  =>  SiteContent::where('slug','contact')->first(),
            ]);
        });


        Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
            $gs = Generalsetting::first();
        	$allowedEmailDomains = explode(',',$gs->allowed_email);
        	return in_array(explode('@', $parameters[0])[1] , $allowedEmailDomains);
        });

       
    }
}
