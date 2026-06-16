    <?php

use Illuminate\Support\Facades\Route;
use League\CommonMark\Environment\Environment;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\VendorTypeController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Vendor\VendorAuthController;
use App\Http\Controllers\Vendor\DashboardController;
use \App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Vendor\ManufacturerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Vendor\ServiceController; 
use App\Http\Controllers\Vendor\RelastateController;
use App\Http\Controllers\RfqController;



Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/postrfq', [HomeController::class,'postrfq'])->name('postrfq');
Route::get('/all_products', [HomeController::class,'products'])->name('products');
Route::get('/category_products/{id}', [HomeController::class,'categoryproducts'])->name('categoryproducts');
Route::get('/subcategory_products/{id}', [HomeController::class,'subcategoryproducts'])->name('subcategoryproducts');
Route::get('/product/{id}', [HomeController::class, 'productdetails'])->name('productdetails');
Route::get('/vendor-details/{id}', [HomeController::class, 'vendorDetails'])->name('vendor.details');
Route::get('/service_list', [HomeController::class,'servicelist'])->name('sevice_list');
Route::get('/rfq_list', [HomeController::class,'rfqlist'])->name('rfq_list');

Route::get('/service/{id}',[HomeController::class,'serviceDetails'])->name('service.details');

Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/upvc/window', [HomeController::class,'upvcWindow'])->name('upvc.window');
Route::get('/aluminium/window', [HomeController::class,'aluminiumWindow'])->name('aluminium.window');
Route::get('/upvc/door', [HomeController::class,'upvcDoor'])->name('upvc.door');
Route::get('/aluminium/door', [HomeController::class,'aluminiumDoor'])->name('aluminium.door');
Route::get('/gallery', [HomeController::class,'gallery'])->name('gallery');
Route::get('/gallery-list/{slug}', [HomeController::class,'galleryList'])->name('gallery.list');
Route::get('/blogs', [HomeController::class,'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [HomeController::class,'blogDetail'])->name('blog.detail');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::post('/contact/store', [HomeController::class,'contactStore'])->name('contact.store');
// Route::get('/enquiry', [HomeController::class,'EnquiryPage'])->name('enquiry');
Route::get('/enquiry/{id}', [HomeController::class,'EnquiryPage'])->name('enquiry');
Route::post('/enquiry-submit', [HomeController::class,'EnquirySubmit'])->name('enquiry.submit');

Route::get('/serviceenquiry/{id}', [HomeController::class,'ServiceEnquiryPage'])->name('serviceenquiry');
Route::post('/service-enquiry-submit',[HomeController::class, 'ServiceEnquirySubmit'])->name('service.enquiry.submit');

Route::get('/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/register/store', [UserAuthController::class, 'registerStore'])->name('register.store');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login/check', [UserAuthController::class, 'loginCheck'])->name('login.check');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
Route::get('/otp-verify/{id}', [UserAuthController::class, 'otpVerifyForm'])->name('otp.verify.form');
Route::post('/otp-verify', [UserAuthController::class, 'otpVerify'])->name('otp.verify');

Route::get('/forgot-password', [UserAuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-send', [UserAuthController::class, 'forgotPasswordSend'])->name('forgot.password.send');
Route::get('/reset-password/{id}', [UserAuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password-update/{id}', [UserAuthController::class, 'resetPasswordUpdate'])->name('reset.password.update');
Route::post('/verify-reset-otp/{id}', [UserAuthController::class, 'verifyResetOtp'])->name('verify.reset.otp');


  Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
  Route::post('/user/profile/update', [UsersController::class, 'profileUpdate'])->name('user.profile.update');
  Route::post('/user/password/update', [UsersController::class, 'passwordUpdate'])->name('user.password.update');

Route::get('/enquiries/{id}/messages', [ChatController::class, 'index'])
    ->name('enquiries.messages');

Route::post('/enquiries/{id}/messages', [ChatController::class, 'store'])
    ->name('enquiries.messages.store');
 

Route::post('/rfq/store', [RfqController::class, 'store'])
    ->name('rfq.store');
Route::post('/chat/start', [ChatController::class, 'start'])
    ->name('chat.start');
Route::delete('/rfq/{id}', [RfqController::class, 'destroy'])
    ->name('rfq.destroy');

Route::get('/get-subcategories', [HomeController::class, 'getSubCategories'])
    ->name('get.subcategories');


Route::post('/enquiries/{enquiry}/messages', [ChatController::class, 'sendMessage'])
    ->name('chat.message.send');

    Route::post('/chat/mark-read/{enquiry}', [ChatController::class, 'markAsRead'])
    ->name('chat.markRead');

Route::get('/supplier_list', [HomeController::class,'Supplierlist'])->name('supplier_list');
Route::get('/supplier_products', [HomeController::class,'Supplierproducts'])->name('supplier_products');
Route::get('/category_product_list/{id}', [HomeController::class,'categoryproductlist'])->name('category_product_list');
Route::get('/bussiness_product_list/{id}', [HomeController::class,'bussinessproductlist'])->name('bussiness_product_list');

Route::get('/properties/{id}/show', [HomeController::class, 'show'])->name('properties.show');


Route::middleware(['web'])->prefix('vendor')->group(function () {

    Route::get('/become', [VendorAuthController::class, 'index'])->name('vendor.index');
    Route::get('/login', [VendorAuthController::class, 'login'])->name('vendor.login');
    Route::post('/login-submit', [VendorAuthController::class, 'loginSubmit'])->name('vendor.login.submit');

    Route::get('/register', [VendorAuthController::class, 'register'])->name('vendor.register');
    Route::get('/get-business-types', [VendorAuthController::class, 'getBusinessTypes'])->name('get.business.types');
    Route::get('/get-categories', [VendorAuthController::class, 'getCategories'])->name('get.categories');
    Route::get('/get-subcategories', [VendorAuthController::class, 'getSubCategories'])->name('get.subcategories');
    Route::post('/register-submit', [VendorAuthController::class, 'registerSubmit'])->name('vendor.register.submit');
    Route::get('/otp/{id}', [VendorAuthController::class, 'otpPage'])->name('vendor.otp.page');
    Route::post('/verify-vendor-otp/{id}', [VendorAuthController::class, 'verifyOtp'])->name('vendor.verify.otp');
    Route::get('/resend-vendor-otp/{id}', [VendorAuthController::class, 'resendOtp'])->name('vendor.resend.otp');
    Route::get('/forgot-password', [VendorAuthController::class, 'forgotPassword'])->name('vendor.forgot.password');
    Route::post('/send-forgot-otp', [VendorAuthController::class, 'sendForgotOtp'])->name('vendor.send.forgot.otp');
    Route::get('/reset-password', [VendorAuthController::class, 'resetPasswordPage'])->name('vendor.reset.password');
    Route::post('/reset-password-submit', [VendorAuthController::class, 'resetPasswordSubmit'])->name('vendor.reset.password.submit');

});


// Route::prefix('manufacturer')
//     ->middleware(['vendor', 'manufacturer'])
//     ->name('manufacturer.')
//     ->group(function () {

//         Route::get('/dashboard',[DashboardController::class, 'manufacturerDashboard'])->name('dashboard');
//         // Route::get('/product-list',[DashboardController::class, 'manufacturerProducts'])->name('product.list');
//         Route::get('/profile',[DashboardController::class, 'manufacturerProfile'])->name('profile');
//          Route::post('/profile/update',[DashboardController::class, 'updateProfile'])->name('profile.update');
//         Route::post('/logout',[ManufacturerController::class, 'logout'])->name('vendor.logout');

//         Route::get('/products', [ManufacturerController::class, 'index'])->name('product.list');
//         Route::get('/products/create', [ManufacturerController::class, 'create'])->name('product.create');
//         Route::post('/products/store', [ManufacturerController::class, 'store'])->name('product.store');
//         Route::get('/products/{id}/edit', [ManufacturerController::class, 'edit'])->name('product.edit');
//         Route::put('/products/{id}', [ManufacturerController::class, 'update'])->name('product.update');
//         Route::delete('/products/{id}', [ManufacturerController::class, 'destroy'])->name('product.delete');
//         Route::get('/get-subcategories', [ManufacturerController::class, 'getSubCategories'])->name('get.subcategories');
//         Route::get('/products/{id}/show', [ManufacturerController::class, 'show'])->name('product.show');
    

// });
Route::prefix('Vendor')
    ->middleware(['vendor']) // REMOVE manufacturer middleware
    ->name('manufacturer.')
    ->group(function () {

        Route::get('/dashboard',[DashboardController::class, 'manufacturerDashboard'])
            ->name('dashboard');

        Route::get('/profile',[DashboardController::class, 'manufacturerProfile'])
            ->name('profile');

        Route::post('/profile/update',[DashboardController::class, 'updateProfile'])
            ->name('profile.update');

        Route::post('/logout',[ManufacturerController::class, 'logout'])
            ->name('vendor.logout');

        Route::get('/products', [ManufacturerController::class, 'index'])
            ->name('product.list');

        Route::get('/products/create', [ManufacturerController::class, 'create'])
            ->name('product.create');

        Route::post('/products/store', [ManufacturerController::class, 'store'])
            ->name('product.store');

        Route::get('/products/{id}/edit', [ManufacturerController::class, 'edit'])
            ->name('product.edit');

        Route::put('/products/{id}', [ManufacturerController::class, 'update'])
            ->name('product.update');

        Route::delete('/products/{id}', [ManufacturerController::class, 'destroy'])
            ->name('product.delete');

        Route::get('/get-subcategories', [ManufacturerController::class, 'getSubCategories'])
            ->name('get.subcategories');

        Route::get('/products/{id}/show', [ManufacturerController::class, 'show'])
            ->name('product.show');

});



Route::prefix('service-vendor')
    ->middleware(['vendor'])->name('service.')
    ->group(function () {

        Route::get('/dashboard',[ServiceController::class, 'serviceDashboard'] )->name('dashboard');

         Route::get('/profile',[ServiceController::class, 'Profile'])->name('profile');
         Route::post('/profile/update',[ServiceController::class, 'updateProfile'])->name('profile.update');
        Route::post('/logout',[ServiceController::class, 'logout'])->name('vendor.logout');

        Route::get('/products', [ServiceController::class, 'index'])->name('product.list');
        Route::get('/products/create', [ServiceController::class, 'create'])->name('product.create');
        Route::post('/products/store', [ServiceController::class, 'store'])->name('product.store');
        Route::get('/products/{id}/edit', [ServiceController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [ServiceController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [ServiceController::class, 'destroy'])->name('product.delete');
        Route::get('/get-subcategories', [ServiceController::class, 'getSubCategories'])->name('get.subcategories');
        Route::get('/products/{id}/show', [ServiceController::class, 'show'])->name('product.show');

});





Route::prefix('real-estate')
    ->middleware(['vendor'])->name('relastate.')
    ->group(function () {

        Route::get('/dashboard',[RelastateController::class, 'realEstateDashboard'])->name('dashboard');
          Route::get('/profile',[RelastateController::class, 'Profile'])->name('profile');
         Route::post('/profile/update',[RelastateController::class, 'updateProfile'])->name('profile.update');
        Route::post('/logout',[RelastateController::class, 'logout'])->name('vendor.logout');

        Route::get('/products', [RelastateController::class, 'index'])->name('product.list');
        Route::get('/products/create', [RelastateController::class, 'create'])->name('product.create');
        Route::post('/products/store', [RelastateController::class, 'store'])->name('product.store');
        Route::get('/products/{id}/edit', [RelastateController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [RelastateController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [RelastateController::class, 'destroy'])->name('product.delete');
        Route::get('/get-subcategories', [RelastateController::class, 'getSubCategories'])->name('get.subcategories');
        Route::get('/products/{id}/show', [RelastateController::class, 'show'])->name('product.show');

});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [AuthController::class, 'settings'])->name('settings');
        Route::post('/settings/update', [AuthController::class, 'updateSettings'])->name('settings.update');


       
        Route::resource('vendor-types', VendorTypeController::class)->names('vendortype');
        Route::resource('business-type', BusinessTypeController::class)->names('businesstype');
        Route::resource('category', CategoryController::class)->names('category');
        Route::get('get-business-types/{vendor_id}', [CategoryController::class, 'getBusinessTypes'])->name('get.business.types');

        Route::get('subcategory', [CategoryController::class, 'subcategoryIndex'])->name('subcategory.index');
        Route::get('subcategory/create', [CategoryController::class, 'subcategoryCreate'])->name('subcategory.create');
        Route::post('subcategory/store', [CategoryController::class, 'subcategoryStore'])->name('subcategory.store');
        Route::get('subcategory/edit/{id}', [CategoryController::class, 'subcategoryEdit'])->name('subcategory.edit');
        Route::put('subcategory/update/{id}', [CategoryController::class, 'subcategoryUpdate'])->name('subcategory.update');
        Route::delete('subcategory/delete/{id}', [CategoryController::class, 'subcategoryDestroy'])->name('subcategory.destroy');
        Route::get('get-categories/{business_id}', [CategoryController::class, 'getCategories'])->name('get.categories');

        Route::resource('users', UserController::class)->names('users');
        
        Route::resource('galleries', GalleryController::class);
        Route::delete('gallery-detail/{id}', [GalleryController::class, 'deleteDetail'])->name('gallery.detail.delete');

        Route::get('/contact/list', [ContactController::class, 'index'])->name('contact.list');
        Route::delete('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

        Route::resource('vendors', VendorController::class)->names('vendors');


        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/{id}', [AdminProductController::class, 'show'])->name('products.show');
        Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.delete');

        Route::get('/services', [AdminProductController::class, 'serviceIndex'])->name('services.index');
        Route::get('/services/{id}/edit', [AdminProductController::class, 'serviceEdit'])->name('services.edit');
        Route::post('/services/{id}/update', [AdminProductController::class, 'serviceUpdate'])->name('services.update');
        Route::delete('/services/{id}/delete', [AdminProductController::class, 'serviceDelete'])->name('services.delete');
        Route::get('/services/{id}/show', [AdminProductController::class, 'serviceShow'])->name('services.show');

        Route::get('/properties', [AdminProductController::class, 'propertyIndex'])->name('properties.index');
        Route::get('/properties/{id}/edit', [AdminProductController::class, 'propertyEdit'])->name('properties.edit');
        Route::post('/properties/{id}/update', [AdminProductController::class, 'propertyUpdate'])->name('properties.update');
        Route::delete('/properties/{id}/delete', [AdminProductController::class, 'propertyDelete'])->name('properties.delete');
        Route::get('/properties/{id}/show', [AdminProductController::class, 'propertyShow'])->name('properties.show');

        
    });
});
