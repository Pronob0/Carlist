
<?php


use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\SupportTicketController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\Vendor\CarController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\PlanController;
use App\Http\Controllers\Vendor\SupportTicketController as VendorSupportTicketController;
use App\Http\Controllers\Vendor\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['maintenance'])->group(function () {


    // ********************************* FRONTEND SECTION *******************************************//
    Route::get('/front-menus', [HomePageController::class, 'frontMenus'])->name('front.menus');
    Route::get('/{slug}', [HomePageController::class, 'page'])->name('front.page');

    Route::get('/all/generalsetting', [HomePageController::class, 'generalSetting'])->name('front.generalSetting');


    Route::get('/front/home', [HomePageController::class, 'homeSection'])->name('front.home');
    Route::get('/front/hero', [HomePageController::class, 'heroSection'])->name('front.hero');
    Route::get('/front/category-section', [HomePageController::class, 'categorySection'])->name('front.categories');
    Route::get('/front/about-section', [HomePageController::class, 'aboutSection'])->name('front.about');
    Route::get('/front/featured-cars', [HomePageController::class, 'featuredCars'])->name('front.featuredCars');
    Route::get('/front/vendor-section', [HomePageController::class, 'vendor'])->name('front.vendor');
    Route::get('/front/recent-cars', [HomePageController::class, 'recentCars'])->name('front.recentCars');
    Route::get('/front/testimonial-section', [HomePageController::class, 'testimonial'])->name('front.testimonial');
    Route::get('/front/footer-section', [HomePageController::class, 'footer'])->name('front.footer');
    Route::get('/front/blog-section', [HomePageController::class, 'blogSection'])->name('front.blogSection');
    Route::post('/subscriber', [HomePageController::class, 'subscriber'])->name('front.subscriber');
    Route::get('/front/social', [HomePageController::class, 'social'])->name('front.social');
    Route::get('front/partner', [HomePageController::class, 'partner'])->name('front.partner');

    // About us 
    Route::get('/front/about-us', [FrontendController::class, 'aboutUs'])->name('front.aboutUs');
    Route::get('/front/contact-us', [FrontendController::class, 'contactUs'])->name('front.contactUs');
    Route::post('/front/contact-us', [FrontendController::class, 'contactSubmit'])->name('front.contactSubmit')->middleware('auth:api');
    
    // Blog page 
    Route::get('/all/blog', [FrontendController::class, 'blogs'])->name('front.blog');
    Route::get('/blog-details/{slug}', [FrontendController::class, 'blogDetails'])->name('front.blogDetails');
    Route::post('/blog/comment/{slug}', [FrontendController::class, 'blogComment'])->name('front.blogComment');
    Route::get('/blog/all/comment/{slug}', [FrontendController::class, 'blogAllComment'])->name('front.blogCategory');
    Route::get('/front/faq-page', [FrontendController::class, 'faqPage'])->name('front.faqPage');
    Route::get('/front/pricing-plan', [FrontendController::class, 'pricingPlan'])->name('front.pricingPlan');

    // ********************************* FRONTEND SECTION *******************************************//
    // Cars 
    Route::get('/all/cars', [FrontendController::class, 'cars'])->name('front.cars');
    Route::get('/car-details/{slug}', [FrontendController::class, 'carDetails'])->name('front.carDetails');
    Route::get('/car-contact', [FrontendController::class, 'carContact'])->name('front.carContact');
    Route::get('/all/vendor/profile/data', [FrontendController::class, 'vendorList'])->name('front.vendors');
    Route::get('/vendor/profile/{slug}', [FrontendController::class, 'vendorProfile'])->name('front.vendorProfile');



    
    Route::group(['prefix' => 'user'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('social/login', [AuthController::class, 'social_login']);
        Route::post('token', [AuthController::class, 'token']);
        Route::post('/otp', [DashboardController::class, 'otp'])->name('user.otp.submit')->middleware('auth:api');
        Route::post('forgot-password',     [AuthController::class, 'forgotPasswordSubmit']);
        Route::post('forgot-password/verify-code',     [AuthController::class, 'verifyCodeSubmit']);
        Route::post('reset-password',     [AuthController::class, 'resetPasswordSubmit']);
        
        Route::middleware(['auth:api', 'email_verify', 'twostep'])->group(function () {
            // Route::get('/with-auth', [FrontendController::class, 'index'])->name('front.index');

            Route::get('dashboard', [DashboardController::class, 'dashboard']);
             // Wishlist Routes
             Route::get('wishlist/store/{id}',   [WishlistController::class, 'store'])->name('wishlist.store');
             Route::get('wishlist',   [WishlistController::class, 'wishlist'])->name('wishlist');
             Route::get('wishlist_ids',   [WishlistController::class, 'wishlist_ids'])->name('wishlist_ids');
             Route::get('wishlist-details/{id}',   [WishlistController::class, 'details'])->name('wishlist.details');
             Route::get('wishlist/remove/{id}',   [WishlistController::class, 'remove'])->name('wishlist.remove');

             // Support Ticket 
            Route::get('support/tickets',   [SupportTicketController::class, 'index'])->name('ticket.index');
            Route::get('support/ticket/messages/{ticket_num}',   [SupportTicketController::class, 'show'])->name('ticket.show');
            Route::post('open/support/ticket',   [SupportTicketController::class, 'openTicket'])->name('ticket.open')->middleware('kyc');
            Route::post('reply/ticket/{ticket_num}',   [SupportTicketController::class, 'replyTicket'])->name('ticket.reply')->middleware('kyc');
            // Messages with user 

            // Profile Routes
            Route::get('get-details',  [DashboardController::class, 'getDetails']);
            Route::post('profile-settings',  [DashboardController::class, 'profileSubmit'])->middleware('kyc');
            Route::post('change-password',  [DashboardController::class, 'changePass'])->name('change.pass');

            // Twofactor Routes
            Route::get('/twoFactor', [DashboardController::class, 'twoFactor'])->name('user.twoFactor');
            Route::post('/createTwoFactor', [DashboardController::class, 'createTwoFactor'])->name('user.createTwoFactor');
            Route::post('/disableTwoFactor', [DashboardController::class, 'disableTwoFactor']);

            // Kyc Routes
            Route::get('/kyc-form-data',               [DashboardController::class, 'kycForm']);
            Route::post('/kyc-form',                   [DashboardController::class, 'kycFormSubmit']);
            Route::get('/user-kyc',                   [DashboardController::class, 'kycShow']);

            // Transaction Routes
            Route::get('transactions',                [DashboardController::class, 'transactions']);
            Route::get('transaction/details/{id}',    [DashboardController::class, 'trxDetails']);

            // deposit Routes
            Route::get('payment/gateways',                    [DepositController::class, 'gateways'])->name('deposit.gateways');
            Route::get('deposit/store',                     [DepositController::class, 'depositStore'])->name('deposit.store');
            Route::get('deposit/history',                   [DepositController::class, 'depositHistory']);
            Route::get('deposit/preview/{trx}',              [DepositController::class, 'depositPreview']);

            // Withdraw Routes
            Route::get('withdraw-methods',  [WithdrawalController::class, 'methods'])->name('withdraw.methods');
            Route::get('withdraw-history',  [WithdrawalController::class, 'history'])->name('withdraw.history');
            Route::get('withdraw-preview/{trx}',   [WithdrawalController::class, 'withdrawPreview']);
            Route::post('withdraw-money',   [WithdrawalController::class, 'withdrawSubmit'])->middleware('kyc');

            // Logout Route
            Route::get('logout',   [AuthController::class, 'logout'])->name('user.logout');
        });
    });

    Route::group(['prefix' => 'vendor'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('social/login', [AuthController::class, 'social_login']);
        Route::post('token', [AuthController::class, 'token']);
        Route::post('/otp', [VendorDashboardController::class, 'otp'])->name('user.otp.submit')->middleware('auth:api');
        Route::post('forgot-password',     [AuthController::class, 'forgotPasswordSubmit']);
        Route::post('forgot-password/verify-code',     [AuthController::class, 'verifyCodeSubmit']);
        Route::post('reset-password',     [AuthController::class, 'resetPasswordSubmit']);
        
        Route::middleware(['auth:api', 'email_verify', 'twostep'])->group(function () {
            // Route::get('/with-auth', [FrontendController::class, 'index'])->name('front.index');
            Route::get('dashboard', [VendorDashboardController::class, 'dashboard']);
            Route::post('social/link', [VendorDashboardController::class, 'socialLink']);

            // carController Routes
            Route::get('car/index', [CarController::class, 'index']);
            Route::post('car/store', [CarController::class, 'store']);

            //get all cars
            Route::get('/all-cars', [CarController::class, 'allCars']);
            Route::get('/pending-cars', [CarController::class, 'pendingCars']);
            Route::get('/active-cars', [CarController::class, 'activeCars']);
            Route::get('/rejected-cars', [CarController::class, 'rejectedCars']);
            Route::get('/sold-cars', [CarController::class, 'soldCars']);
            Route::get('/featured-cars', [CarController::class, 'featuredCars']);
            Route::get('edit-car/{slug}', [CarController::class, 'editCar']);

            Route::post('car/update/{slug}', [CarController::class, 'updateCar']);

            // By Plan 
            Route::get('/pricing-plan', [PlanController::class, 'pricingPlan'])->name('vendor.pricingPlan');


            Route::get('/transaction', [TransactionController::class, 'transaction'])->name('vendor.transaction');

             // Support Ticket 
            Route::get('support/tickets/pronob',   [VendorSupportTicketController::class, 'index'])->name('ticket.index');
            Route::get('support/ticket/messages/{ticket_num}',   [VendorSupportTicketController::class, 'show'])->name('ticket.show');
            Route::post('open/support/ticket',   [VendorSupportTicketController::class, 'openTicket'])->name('ticket.open')->middleware('kyc');
            Route::post('reply/ticket/{ticket_num}',   [VendorSupportTicketController::class, 'replyTicket'])->name('ticket.reply')->middleware('kyc');

            // Messages with user 
        
            // Profile Routes
            Route::get('get-details',  [VendorDashboardController::class, 'getDetails']);
            Route::post('profile-settings',  [VendorDashboardController::class, 'profileSubmit'])->middleware('kyc');
            Route::post('change-password',  [VendorDashboardController::class, 'changePass'])->name('change.pass');

            // Twofactor Routes
            Route::get('/twoFactor', [VendorDashboardController::class, 'twoFactor'])->name('user.twoFactor');
            Route::post('/createTwoFactor', [VendorDashboardController::class, 'createTwoFactor'])->name('user.createTwoFactor');
            Route::post('/disableTwoFactor', [VendorDashboardController::class, 'disableTwoFactor']);

            // Kyc Routes
            Route::get('/kyc-form-data',               [VendorDashboardController::class, 'kycForm']);
            Route::post('/kyc-form',                   [VendorDashboardController::class, 'kycFormSubmit']);
            Route::get('/user-kyc',                   [VendorDashboardController::class, 'kycShow']);

            // Transaction Routes
            Route::get('transactions',                [VendorDashboardController::class, 'transactions']);
            Route::get('transaction/details/{id}',    [VendorDashboardController::class, 'trxDetails']);

            // deposit Routes
            Route::get('payment/gateways',                    [DepositController::class, 'gateways'])->name('deposit.gateways');
            Route::get('deposit/store',                     [DepositController::class, 'depositStore'])->name('deposit.store');
            Route::get('deposit/history',                   [DepositController::class, 'depositHistory']);
            Route::get('deposit/preview/{trx}',              [DepositController::class, 'depositPreview']);

            // Withdraw Routes
            Route::get('withdraw-methods',  [WithdrawalController::class, 'methods'])->name('withdraw.methods');
            Route::get('withdraw-history',  [WithdrawalController::class, 'history'])->name('withdraw.history');
            Route::get('withdraw-preview/{trx}',   [WithdrawalController::class, 'withdrawPreview']);
            Route::post('withdraw-money',   [WithdrawalController::class, 'withdrawSubmit'])->middleware('kyc');

            Route::get('logout',   [AuthController::class, 'logout'])->name('user.logout');
        });
    });



});
