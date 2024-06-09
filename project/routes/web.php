<?php


use App\Http\Controllers\Deposit\MercadopagoController;
use App\Http\Controllers\Deposit\PaypalController;
use App\Http\Controllers\Deposit\RazorpayController;
use App\Http\Controllers\Deposit\StripeController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;


Route::get('currency-rate', [FrontendController::class, 'currencyRate'])->name('currency.rate');
Route::post('the/genius/ocean/2441139', [FrontendController::class, 'subscription']);
Route::get('finalize', [FrontendController::class, 'finalize']);
Route::get('/paypal-submit/{amount}/{user}/{id}', [PaypalController::class,'store'])->name('deposit.paypal.submit');
Route::get('/paypal/deposit/notify/{num}/{id}', [PaypalController::class,'notify'])->name('deposit.paypal.notify');
Route::get('/paypal/deposit/cancle', [PaypalController::class,'cancel'])->name('deposit.paypal.cancel');
Route::get('/deposit/stripe-submit/{amount}/{user}/{id}', [StripeController::class,'store'])->name('deposit.stripe.submit');
Route::get('/deposit/payment/success/{amount}/{user}/{id}', [StripeController::class,'success'])->name('user.deposit.success');
Route::get('/deposit/mercadopago-submit/{amount}/{user}/{id}', [MercadopagoController::class,'store'])->name('deposit.mercadopago.submit');
Route::get('/payment/final/form/{user}/{curr}/{gateway}/{amount}' , [FrontendController::class, 'finalForm'])->name('final.form');
Route::get('/deposit/razorpay-submit/{amount}/{user}/{id}', [RazorpayController::class,'store'])->name('deposit.razorpay.submit');
Route::Post('/deposit/razorpay-notify', [RazorpayController::class,'notify'])->name('deposit.razorpay.notify');
Route::get('/maintenance', [FrontendController::class, 'maintenance'])->name('front.maintenance');
