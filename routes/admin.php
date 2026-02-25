<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    VerifyEmailController
};


Route::prefix('/admin')->name('admin.')->middleware('no-cache')->group(function () {

    Route::redirect('/', '/admin/dashboard')->middleware(['auth:admin', 'verified']);
    Route::view('/dashboard', 'admin.dashboard')->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('user/portal/{user}', [\App\Http\Controllers\Admin\UserController::class, 'portal'])->name('user.portal');
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('brand', \App\Http\Controllers\Admin\BrandController::class);
        Route::resource('unit', \App\Http\Controllers\Admin\UnitController::class);
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('subcategory', \App\Http\Controllers\Admin\SubcategoryController::class);
        Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);
        Route::resource('image', \App\Http\Controllers\Admin\ImageController::class);
        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
        Route::resource('video', \App\Http\Controllers\Admin\VideoController::class);
        Route::resource('notice', \App\Http\Controllers\Admin\NoticeController::class);
        Route::resource('termsandcondition', \App\Http\Controllers\Admin\TermsandconditionController::class);
        Route::resource('sitesetting', \App\Http\Controllers\Admin\SitesettingController::class);
        Route::resource('attribute', \App\Http\Controllers\Admin\AttributeController::class);
        Route::resource('shipping', \App\Http\Controllers\Admin\ShippingController::class);
        Route::resource('client', \App\Http\Controllers\Admin\ClientController::class);
        Route::resource('certificate', \App\Http\Controllers\Admin\CertificateController::class);
        Route::resource('blog', \App\Http\Controllers\Admin\BlogController::class);
        Route::resource('team', \App\Http\Controllers\Admin\TeamController::class);
        Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);
        Route::resource('contact', \App\Http\Controllers\Admin\ContactController::class);
    });

    Route::middleware('guest:admin')->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

});

