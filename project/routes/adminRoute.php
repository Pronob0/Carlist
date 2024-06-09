<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\KycManageController;
use App\Http\Controllers\Admin\ManageRoleController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\WithdrawalController;

use App\Http\Controllers\Admin\ManageStaffController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\ManageChargeController;
use App\Http\Controllers\Admin\ManageModuleController;
use App\Http\Controllers\Admin\ManageTicketController;
use App\Http\Controllers\Admin\ManageCountryController;
use App\Http\Controllers\Admin\ManageDepositController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ManageCurrencyController;

use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConditionController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\HeaderSectionController;
use App\Http\Controllers\Admin\ManageVendorController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TransmissionController;
use Illuminate\Support\Facades\Artisan;

// ************************** ADMIN SECTION START ***************************//

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',            [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',           [LoginController::class, 'login']);

    Route::get('/forgot-password',   [LoginController::class, 'forgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot-password',   [LoginController::class, 'forgotPasswordSubmit']);
    Route::get('forgot-password/verify-code',     [LoginController::class, 'verifyCode'])->name('verify.code');
    Route::post('forgot-password/verify-code',     [LoginController::class, 'verifyCodeSubmit']);
    Route::get('reset-password',     [LoginController::class, 'resetPassword'])->name('reset.password');
    Route::post('reset-password',     [LoginController::class, 'resetPasswordSubmit']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        //------------ ADMIN DASHBOARD & PROFILE SECTION ------------
        Route::get('/',                 [AdminController::class, 'index'])->name('dashboard');
        Route::get('/profile',          [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update',  [AdminController::class, 'profileupdate'])->name('profile.update');
        Route::get('/password',         [AdminController::class, 'passwordreset'])->name('password');
        Route::post('/password/update', [AdminController::class, 'changepass'])->name('password.update');
        //------------ ADMIN DASHBOARD & PROFILE SECTION ENDS ------------

         // brand Route @s
         Route::get('/manage-brand', [BrandController::class, 'index'])->name('brand.index');
         Route::get('/create-brand', [BrandController::class, 'create'])->name('brand.create');
         Route::post('/store-brand', [BrandController::class, 'store'])->name('brand.store');
         Route::get('/edit-brand/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
         Route::put('/update-brand/{id}', [BrandController::class, 'update'])->name('brand.update');
         Route::delete('/delete-brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
         // brand Route @e

        //  category Route @s
        Route::get('/manage-category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/delete-service', [CategoryController::class, 'destroy'])->name('category.destroy');


        // condition Route @s
        Route::get('/manage-condition', [ConditionController::class, 'index'])->name('condition.index');
        Route::post('/condition/store', [ConditionController::class, 'store'])->name('condition.store');
        Route::put('/condition/update/{id}', [ConditionController::class, 'update'])->name('condition.update');
        Route::delete('/condition/delete-service', [ConditionController::class, 'destroy'])->name('condition.destroy');


        // modal Route @s
        Route::get('/manage-model', [ModelController::class, 'index'])->name('model.index');
        Route::post('/model/store', [ModelController::class, 'store'])->name('model.store');
        Route::put('/model/update/{id}', [ModelController::class, 'update'])->name('model.update');
        Route::delete('/model/delete-service', [ModelController::class, 'destroy'])->name('model.destroy');

        // fuel type Route @s
        Route::get('/manage-fuel-type', [FuelController::class, 'index'])->name('fuel.type.index');
        Route::post('/fuel-type/store', [FuelController::class, 'store'])->name('fuel.store');
        Route::put('/fuel-type/update/{id}', [FuelController::class, 'update'])->name('fuel.update');
        Route::delete('/fuel-type/delete-service', [FuelController::class, 'destroy'])->name('fuel.destroy');


        // transmission type Route @s
        Route::get('/manage-transmission-type', [TransmissionController::class, 'index'])->name('transmission.index');
        Route::post('/transmission-type/store', [TransmissionController::class, 'store'])->name('transmission.store');
        Route::put('/transmission-type/update/{id}', [TransmissionController::class, 'update'])->name('transmission.update');
        Route::delete('/transmission-type/delete-service', [TransmissionController::class, 'destroy'])->name('transmission.destroy');

        // Management Car 
        Route::get('/manage-car', [CarController::class, 'index'])->name('car.index');
        Route::get('/create-car', [CarController::class, 'create'])->name('car.create');
        Route::post('/store-car', [CarController::class, 'store'])->name('car.store');
        Route::get('/edit-car/{car}', [CarController::class, 'edit'])->name('car.edit');
        Route::put('/update-car/{id}', [CarController::class, 'update'])->name('car.update');
        Route::delete('/delete-car/', [CarController::class, 'destroy'])->name('car.destroy');

        Route::get('/pending-car', [CarController::class, 'pending'])->name('car.pending');
        Route::get('/publish-car', [CarController::class, 'publish'])->name('car.publish');
        Route::get('/reject-car', [CarController::class, 'reject'])->name('car.reject');
        Route::get('/featured-car', [CarController::class, 'featured'])->name('car.featured');
        Route::post('car/gallery/delete', [CarController::class, 'deleteGallery'])->name('car.gallery.delete');


        // package routes 
        Route::get('/manage-package', [PackageController::class, 'index'])->name('package.index');
        Route::get('/create-package', [PackageController::class, 'create'])->name('package.create');
        Route::post('/store-package', [PackageController::class, 'store'])->name('package.store');
        Route::get('/edit-package/{package}', [PackageController::class, 'edit'])->name('package.edit');
        Route::put('/update-package/{package}', [PackageController::class, 'update'])->name('package.update');
        Route::delete('/delete-package/{package}', [PackageController::class, 'destroy'])->name('package.destroy');


        // user package routes
        Route::get('/manage-user-package', [PackageController::class, 'userPackage'])->name('userpackage.index');


        //profit report
        Route::get('/profit-reports',                 [AdminController::class, 'profitReports'])->name('profit.report')->middleware('permission:profit report');
        Route::get('/transaction-report',                 [AdminController::class, 'transactions'])->name('transactions')->middleware('permission:transactions');

        //==================================== PAGE SECTION  ==============================================//

        Route::get('page',       [PageController::class, 'index'])->name('page.index')->middleware('permission:manage page');
        Route::get('page/create',       [PageController::class, 'create'])->name('page.create')->middleware('permission:page create');
        Route::post('page/store',       [PageController::class, 'store'])->name('page.store')->middleware('permission:page store');
        Route::get('page/edit/{page}',       [PageController::class, 'edit'])->name('page.edit')->middleware('permission:page edit');
        Route::put('page/update/{page}',       [PageController::class, 'update'])->name('page.update')->middleware('permission:page update');
        Route::post('page/remove',       [PageController::class, 'destroy'])->name('page.remove')->middleware('permission:page remove');

        //==================================== PAGE SECTION END ==============================================//

        // About us page  
        Route::get('about-us',       [AboutController::class, 'aboutUs'])->name('front.about')->middleware('permission:about us');
        Route::post('about-us/update',       [AboutController::class, 'update'])->name('about.update')->middleware('permission:about us');
        Route::post('about-us/add-table',       [AboutController::class, 'addTable'])->name('about.table')->middleware('permission:about us');
        Route::post('about-us/update-table',     [AboutController::class, 'updateTable'])->name('about.table.update')->middleware('permission:about us');
        Route::post('about-us/delete-table',     [AboutController::class, 'deleteTable'])->name('about.table.delete')->middleware('permission:about us');
    
        //manage blogs

        Route::get('blog-category',       [BlogCategoryController::class, 'index'])->name('bcategory.index')->middleware('permission:manage blog-category');
        Route::post('blog-category/store',       [BlogCategoryController::class, 'store'])->name('bcategory.store')->middleware('permission:store blog-category');
        Route::put('blog-category/update/{id}',       [BlogCategoryController::class, 'update'])->name('bcategory.update')->middleware('permission:update blog-category');

        Route::get('blog',       [BlogController::class, 'index'])->name('blog.index')->middleware('permission:manage blog');
        Route::get('blog/create',       [BlogController::class, 'create'])->name('blog.create')->middleware('permission:blog create');
        Route::post('blog/store',       [BlogController::class, 'store'])->name('blog.store')->middleware('permission:blog store');
        Route::get('blog/edit/{blog}',       [BlogController::class, 'edit'])->name('blog.edit')->middleware('permission:blog edit');
        Route::put('blog/update/{blog}',       [BlogController::class, 'update'])->name('blog.update')->middleware('permission:blog update');
        Route::delete('blog-delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy')->middleware('permission:blog destroy');
        //==================================== Manage Currency ==============================================//


        Route::get('/manage-currency', [ManageCurrencyController::class, 'index'])->name('currency.index')->middleware('permission:manage currency');
        Route::get('/add-currency', [ManageCurrencyController::class, 'addCurrency'])->name('currency.add')->middleware('permission:add currency');
        Route::post('/add-currency', [ManageCurrencyController::class, 'store'])->middleware('permission:add currency');
        Route::get('/edit-currency/{id}', [ManageCurrencyController::class, 'editCurrency'])->name('currency.edit')->middleware('permission:edit currency');
        Route::post('/update-currency/{id}', [ManageCurrencyController::class, 'updateCurrency'])->name('currency.update')->middleware('permission:update currency');
        Route::delete('/delete-currency', [ManageCurrencyController::class, 'deleteCurrency'])->name('currency.delete')->middleware('permission:delete currency');


        // manage charges

        Route::get('/manage-charges', [ManageChargeController::class, 'index'])->name('manage.charge')->middleware('permission:manage charges');
        Route::get('/edit-charge/{id}', [ManageChargeController::class, 'editCharge'])->name('edit.charge')->middleware('permission:edit charge');
        Route::post('/update-charge/{id}', [ManageChargeController::class, 'updateCharge'])->name('update.charge')->middleware('permission:update charge');


        //manage Country

        Route::get('/manage-country', [ManageCountryController::class, 'index'])->name('country.index')->middleware('permission:manage country');
        Route::post('/add-country', [ManageCountryController::class, 'store'])->name('country.store')->middleware('permission:add country');
        Route::post('/update-country', [ManageCountryController::class, 'update'])->name('country.update')->middleware('permission:update country');


        //==================================== Manage Module ==============================================//

        Route::get('/manage-module', [ManageModuleController::class, 'index'])->name('manage.module')->middleware('permission:manage modules');
        Route::post('/update-module', [ManageModuleController::class, 'update'])->name('update.module')->middleware('permission:update module');

        //Manage Kyc
        Route::get('/manage-kyc-form', [KycManageController::class, 'index'])->name('manage.kyc')->middleware('permission:manage kyc');
        Route::get('/manage-kyc-form/{user}', [KycManageController::class, 'userKycForm'])->name('manage.kyc.user')->middleware('permission:manage kyc form');
        Route::post('/manage-kyc-form/{user}', [KycManageController::class, 'kycForm'])->middleware('permission:kyc form add');
        Route::post('/kyc-form/update', [KycManageController::class, 'kycFormUpdate'])->name('kyc.form.update')->middleware('permission:kyc form update');
        Route::post('/kyc-form/delete', [KycManageController::class, 'deletedField'])->name('kyc.form.delete')->middleware('permission:kyc form delete');
        Route::get('/kyc-info/{user}', [KycManageController::class, 'kycInfo'])->name('kyc.info')->middleware('permission:kyc info');
        Route::get('/kyc-info/{user}/{id}', [KycManageController::class, 'kycDetails'])->name('kyc.details')->middleware('permission:kyc details');
        Route::post('/kyc-reject/{user}/{id}', [KycManageController::class, 'rejectKyc'])->name('kyc.reject')->middleware('permission:kyc reject');
        Route::post('/kyc-approve/{user}/{id}', [KycManageController::class, 'approveKyc'])->name('kyc.approve')->middleware('permission:kyc approve');


        //==================================== GENERAL SETTING SECTION ==============================================//


        Route::get('/general-settings',            [GeneralSettingController::class, 'siteSettings'])->name('gs.site.settings')->middleware('permission:general setting');

        Route::post('/general-settings/update',     [GeneralSettingController::class, 'update'])->name('gs.update')->middleware('permission:general settings update');

        Route::get('/general-settings/logo-favicon', [GeneralSettingController::class, 'logo'])->name('gs.logo')->middleware('permission:general settings logo favicon');
        // breadcumb banner 
        // homepage 
        Route::get('/general-settings/homepage', [GeneralSettingController::class, 'homepage'])->name('gs.homepage')->middleware('permission:homepage');
        Route::get('/home/status/{status}', [GeneralSettingController::class, 'homeStatus'])->name('home.status')->middleware('permission:homepage');

        Route::get('/general-settings/favicon', [GeneralSettingController::class, 'favicon'])->name('gs.favicon')->middleware('permission:general settings favicon');

        Route::get('/general-settings/breadcumb-banner', [GeneralSettingController::class, 'breadcumbBanner'])->name('gs.breadcumb.banner')->middleware('permission:general settings breadcumb banner');
        Route::get('/general-settings/charge', [GeneralSettingController::class, 'charge'])->name('gs.charge')->middleware('permission:charge settings');
        Route::post('/general-settings/charge', [GeneralSettingController::class, 'chargeUpdate'])->name('gs.charge.update')->middleware('permission:charge settings');

        Route::get('/general-settings/menu-builder',  [GeneralSettingController::class, 'menu'])->name('front.menu')->middleware('permission:menu builder');

        Route::get('/general-settings/maintenance', [GeneralSettingController::class, 'maintenance'])->name('gs.maintenance')->middleware('permission:maintainance');

        Route::get('/general-settings/status/update/{value}', [GeneralSettingController::class, 'StatusUpdate'])->name('gs.status')->middleware('permission:general settings status update');


        //==================================== GENERAL SETTING SECTION ==============================================//




        //==================================== EMAIL SETTING SECTION ==============================================//

        Route::get('/email-templates',      [EmailController::class, 'index'])->name('mail.index')->middleware('permission:email templates');

        Route::get('/email-templates/{id}', [EmailController::class, 'edit'])->name('mail.edit')->middleware('permission:template edit');

        Route::post('/email-templates/{id}', [EmailController::class, 'update'])->name('mail.update')->middleware('permission:template update');

        Route::get('/email-config',         [EmailController::class, 'config'])->name('mail.config')->middleware('permission:email config');

        Route::get('/group-email',           [EmailController::class, 'groupEmail'])->name('mail.group.show')->middleware('permission:group email');

        Route::post('/groupemailpost',      [EmailController::class, 'groupemailpost'])->name('group.submit')->middleware('permission:group email');



        //==================================== EMAIL SETTING SECTION END ==============================================//



        Route::get('/deposits',             [ManageDepositController::class, 'deposits'])->name('deposit')->middleware('permission:manage deposit');

        Route::post('/approve-deposit',             [ManageDepositController::class, 'approve'])->name('approve.deposit')->middleware('permission:approve deposit');

        Route::post('/reject-deposit',             [ManageDepositController::class, 'reject'])->name('reject.deposit')->middleware('permission:reject deposit');


        Route::get('/payment-gateways',        [PaymentGatewayController::class, 'index'])->name('gateway')->middleware('permission:manage payment gateway');

        Route::get('add/payment-gateway',        [PaymentGatewayController::class, 'create'])->name('gateway.create')->middleware('permission:add payment gateway');

        Route::post('/store/payment-gateway',        [PaymentGatewayController::class, 'store'])->name('gateway.store')->middleware('permission:store payment gateway');

        Route::get('/payment-gateway/edit/{paymentgateway}',        [PaymentGatewayController::class, 'edit'])->name('gateway.edit')->middleware('permission:edit payment gateway');

        Route::post('/payment-gateway/update/{gateway}',        [PaymentGatewayController::class, 'update'])->name('gateway.update')->middleware('permission:update payment gateway');

        //==================================== PAYMENTGATEWAY SETTING SECTION END ==============================================//


        //==================================== LANGUAGE SETTING SECTION ==============================================//

        // webiste language
        Route::resource('language', LanguageController::class)->middleware('permission:manage language');

        Route::post('add-translate/{id}', [LanguageController::class, 'storeTranslate'])->name('translate.store')->middleware('permission:manage language');

        Route::post('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('translate.update')->middleware('permission:manage language');

        Route::post('remove-translate', [LanguageController::class, 'removeTranslate'])->name('translate.remove')->middleware('permission:manage language');

        Route::post('language/status-update', [LanguageController::class, 'statusUpdate'])->name('update-status.language')->middleware('permission:manage language');

        Route::post('language/remove', [LanguageController::class, 'destroy'])->name('remove.language')->middleware('permission:manage language');

        // admin language
      
        //==================================== LANGUAGE SETTING SECTION END =============================================//



        //==================================== ADMIN SEO SETTINGS SECTION ====================================
        Route::resource('seo-setting', SeoSettingController::class)->middleware('permission:seo settings');
        //==================================== ADMIN SEO SETTINGS SECTION ENDS ====================================

        //==================================== USER SECTION  ==============================================//

        // active user 

        Route::get('manage-users/', [ManageUserController::class, 'index'])->name('user.index')->middleware('permission:manage user');
        Route::get('user/create', [ManageUserController::class, 'create'])->name('user.create')->middleware('permission:manage user');
        Route::post('user/store', [ManageUserController::class, 'store'])->name('user.store')->middleware('permission:manage user');
        Route::get('user-details/{id}', [ManageUserController::class, 'details'])->name('user.details')->middleware('permission:edit user');
        Route::post('user-profile/update/{id}', [ManageUserController::class, 'profileUpdate'])->name('user.profile.update')->middleware('permission:update user');
        Route::post('balance-modify', [ManageUserController::class, 'modifyBalance'])->name('user.balance.modify')->middleware('permission:user balance modify');
        Route::get('user-login/info/{id}', [ManageUserController::class, 'loginInfo'])->name('user.login.info')->middleware('permission:user login logs');
        Route::delete('user-delete/{blog}', [ManageUserController::class, 'destroy'])->name('user.destroy');

        // Vendor management & vendor product route here
        Route::get('manage-vendors/', [ManageVendorController::class, 'vendors'])->name('vendor.index')->middleware('permission:manage vendor');
        Route::get('vendor-details/{id}', [ManageVendorController::class, 'vendorDetails'])->name('vendor.details')->middleware('permission:edit vendor');
        Route::post('vendor-profile/update/{id}', [ManageVendorController::class, 'vendorProfileUpdate'])->name('vendor.profile.update')->middleware('permission:update vendor');
        Route::get('vendor-login/info/{id}', [ManageVendorController::class, 'vendorLoginInfo'])->name('vendor.login.info')->middleware('permission:vendor login logs');
        Route::delete('vendor-delete/{blog}', [ManageVendorController::class, 'vendorDestroy'])->name('vendor.destroy');

        //================= Site Contents ======================

        

        Route::get('header-section', [HeaderSectionController::class, 'index'])->name('header.section')->middleware('permission:header section');
        Route::post('header-section', [HeaderSectionController::class, 'update'])->name('header.section.update')->middleware('permission:header section');

        Route::get('/frontend-sections', [SiteContentController::class, 'index'])->name('frontend.index')->middleware('permission:site contents');

        Route::get('/frontend-section/edit/{id}', [SiteContentController::class, 'edit'])->name('frontend.edit')->middleware('permission:edit site contents');

        Route::post('/frontend-section/content-update/{id}', [SiteContentController::class, 'contentUpdate'])->name('frontend.content.update')->middleware('permission:site content update');

        Route::post('/frontend-section/sub-content-update/{id}', [SiteContentController::class, 'subContentUpdate'])->name('frontend.sub-content.update')->middleware('permission:site sub-content update');

        Route::post('/frontend-section/sub-content/update-single', [SiteContentController::class, 'subContentUpdateSingle'])->name('frontend.sub-content.single.update')->middleware('permission:site sub-content update');

        Route::post('/frontend-section/sub-content/remove', [SiteContentController::class, 'subContentRemove'])->name('frontend.sub-content.remove')->middleware('permission:site sub-content update');

        Route::post('/frontend-section/status-update', [SiteContentController::class, 'statusUpdate'])->name('frontend.status.update')->middleware('permission:section status update');

        //withdraw

        Route::get('withdraw/method', [WithdrawMethodController::class, 'index'])->name('withdraw')->middleware('permission:withdraw method');

        Route::get('withdraw/method-create', [WithdrawMethodController::class, 'create'])->name('withdraw.create')->middleware('permission:withdraw method create');

        Route::post('withdraw/method-create', [WithdrawMethodController::class, 'store'])->middleware('permission:withdraw method create');

        Route::get('withdraw/method/search', [WithdrawMethodController::class, 'index'])->name('withdraw.search')->middleware('permission:withdraw method search');

        Route::get('withdraw/edit/{id}', [WithdrawMethodController::class, 'edit'])->name('withdraw.edit')->middleware('permission:withdraw method edit');

        Route::post('withdraw/update/{method}', [WithdrawMethodController::class, 'update'])->name('withdraw.update')->middleware('permission:withdraw method update');

        Route::get('withdraw/pending', [WithdrawalController::class, 'pending'])->name('withdraw.pending')->middleware('permission:pending withdraw');

        Route::get('withdraw/accepted', [WithdrawalController::class, 'accepted'])->name('withdraw.accepted')->middleware('permission:accepted withdraw');

        Route::get('withdraw/rejected', [WithdrawalController::class, 'rejected'])->name('withdraw.rejected')->middleware('permission:rejected withdraw');

        Route::post('withdraw/accept/{withdraw}', [WithdrawalController::class, 'withdrawAccept'])->name('withdraw.accept')->middleware('permission:withdraw accept');

        Route::post('withdraw/reject/{withdraw}', [WithdrawalController::class, 'withdrawReject'])->name('withdraw.reject')->middleware('permission:withdraw reject');


        //role manage

        Route::get('manage/role', [ManageRoleController::class, 'index'])->name('role.manage')->middleware('permission:manage role');

        Route::get('create/role', [ManageRoleController::class, 'create'])->name('role.create')->middleware('permission:create role');

        Route::post('create/role', [ManageRoleController::class, 'store'])->middleware('permission:create role');

        Route::get('edit/permissions/{id}', [ManageRoleController::class, 'edit'])->name('role.edit')->middleware('permission:edit permissions');

        Route::post('update/permissions/{id}', [ManageRoleController::class, 'update'])->name('role.update')->middleware('permission:update permissions');



        //manage staff

        Route::get('manage/staff', [ManageStaffController::class, 'index'])->name('staff.manage')->middleware('permission:manage staff');

        Route::post('add/staff', [ManageStaffController::class, 'addStaff'])->name('staff.add')->middleware('permission:add staff');

        Route::post('update/staff/{id}', [ManageStaffController::class, 'updateStaff'])->name('staff.update')->middleware('permission:update staff');

        //support ticket
        Route::get('manage/tickets/{type}', [ManageTicketController::class, 'index'])->name('ticket.manage')->middleware('permission:manage ticket');

        Route::post('reply/ticket/{ticket_num}',   [ManageTicketController::class, 'replyTicket'])->name('ticket.reply')->middleware('permission:manage ticket')->middleware('permission:reply ticket');


        Route::get('/clear-cache', function () {
            Artisan::call('optimize:clear');
            return back()->with('success', 'Cache cleared successfully');
        })->name('clear.cache');
    });
});



Route::get('/activation', [AdminController::class, 'activation'])->name('admin-activation-form');
Route::post('/activation', [AdminController::class, 'activation_submit'])->name('admin-activate-purchase');
