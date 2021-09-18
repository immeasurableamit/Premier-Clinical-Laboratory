<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SiteAdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteMangeController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'LandingPage'])->name('landing.view');

Route::get('/admin/login', [LoginController::class, 'LoginView'])->name('login.view');

Route::get('/customer/login', [LoginController::class, 'CustomerLoginView'])->name('cust.login.view');

Route::get('/employee/login', [LoginController::class, 'EmployeeView'])->name('emp.login.view');

Route::get('/customer/register', [SignupController::class, 'CustomerSignupView'])->name('cust.signup.view');

Route::get('/verifyemail', [SignupController::class, 'VerifyView'])->name('verify.email.view');
Route::post('/verifyotp', [SignupController::class, 'verifymethod'])->name('verifymethod');

Route::post('/signup', [SignupController::class, 'signup'])->name('cust.signup.logic');

Route::any('/login', [LoginController::class, 'Login'])->name('login');
Route::any('/emp/login', [LoginController::class, 'EmployeeLogin'])->name('emp.login');
Route::any('/cust/login', [LoginController::class, 'CustomerLogin'])->name('customerloginfunction');


Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');

Route::get('/forgot', [ResetPassword::class, 'view'])->name('forgot');
Route::get('/forgot/emp', [ResetPassword::class, 'viewemp'])->name('forgot.emp');

Route::get('/user/forgot', [SignupController::class, 'Forgot'])->name('user.forgot');
Route::get('/mail/check/user', [SignupController::class, 'Checkmail'])->name('user.check.mail');

Route::get('/mail/check', [ResetPassword::class, 'MailCheck'])->name('check.mail');


Route::get('/mail/check/emp', [ResetPassword::class, 'MailCheckEmp'])->name('check.mail.emp');

Route::get('/recovey/token/{token}/{type}', [ResetPassword::class, 'VerifyToken'])->name('verify.token');

Route::post('/update/store', [ResetPassword::class, 'Store'])->name('update.store.password');

Route::post('/update/password', [ResetPassword::class, 'Store'])->name('update.password');

// Route::view('/forgot', 'web.auth.forgot')->name('forgot');

Route::prefix('admin')->as('admin.')->middleware(['CheckAuth', 'nocache'])->group(function () {


    Route::get('/change-pass', [UserController::class, 'PasswordUpdateView'])->name('pass.view');
    Route::post('/update-pass', [UserController::class, 'PasswordUpdate'])->name('update.pass');

    Route::middleware(['CheckRole:10'])->group(function () {
        Route::get('/', [DashBoardController::class, 'index'])->name('dash');
        // Route::resource('site', 'SiteController');
        Route::resource('site', 'App\Http\Controllers\SiteController');
        Route::resource('site-admin', 'App\Http\Controllers\SiteAdminController');
        Route::resource('employess', 'App\Http\Controllers\EmployeesController');
        Route::resource('question', 'App\Http\Controllers\QuestionsController');
        Route::get('/employess/details/{id}', [EmployeesController::class, 'Details'])->name('employess.details');
        Route::get('/employess/print/{id}', [EmployeesController::class, 'Print'])->name('employess.print');
        Route::post('/employess/assign', [EmployeesController::class, 'Assign'])->name('employess.assign');

        Route::get('/emp/import', [EmployeesController::class, 'ImportView'])->name('employess.import.view');

        Route::get('/emp/import/show', [EmployeesController::class, 'ImportShow'])->name('employess.import.show');
        Route::post('/emp/import/store', [EmployeesController::class, 'ImportStore'])->name('employess.import.store');
    });

    Route::middleware(['CheckRole:1'])->group(function () {
        Route::get('/onwer/dash', [DashBoardController::class, 'SiteDash'])->name('site.dash');

        Route::get('/manage/list', [SiteMangeController::class, 'list'])->name('manage.List');
        Route::get('/manage/add-in-site', [SiteMangeController::class, 'AddInSite'])->name('manage.addinsite');
        Route::get('/tests', [SiteAdminController::class, 'list_tests'])->name('tests');
        Route::get('/negative/{id}', [SiteAdminController::class, 'SetNegative'])->name('negative');
        Route::get('/positive/{id}', [SiteAdminController::class, 'SetPositive'])->name('positive');
        Route::post('/manage/store', [SiteMangeController::class, 'store'])->name('manage.store');
        Route::post('/manage/temp/store', [SiteMangeController::class, 'TempStore'])->name('manage.temp.store');
        Route::get('/manage/details/{id}', [SiteMangeController::class, 'Details'])->name('manage.details');

        Route::get('/manage/screening/{id}', [SiteMangeController::class, 'Screening'])->name('manage.screening');
        Route::post('/manage/screening/store', [SiteMangeController::class, 'ScreeningStore'])->name('manage.screening.store');
        // Route::post('/manage/screening/store', [SiteMangeController::class, 'ScreeningStore'])->name('manage.screening.store');


        Route::get('/manage/print/{id}', [SiteMangeController::class, 'Print'])->name('manage.print');
    });
    Route::post('/package/assign', [PackageController::class, 'Assign'])->name('package.assign');
    Route::get('/package/index', [PackageController::class, 'index'])->name('package.index');
    Route::get('/package/done', [PackageController::class, 'DoneTests'])->name('package.done');
    Route::get('/package/export', [PackageController::class, 'Export'])->name('package.export');
    Route::get('/package/export/excel', [PackageController::class, 'ExcelExport'])->name('package.export.excel');
    Route::get('/package/pending', [DashBoardController::class, 'PendingTests'])->name('package.pending');
    Route::get('/package/positive', [DashBoardController::class, 'PositiveTests'])->name('package.positive');
    Route::get('/package/negative', [DashBoardController::class, 'NegativeTests'])->name('package.negative');
    Route::get('/package/alerts', [DashBoardController::class, 'AlertsEmployes'])->name('package.alerts');
    Route::get('/risk/down/{id}', [DashBoardController::class, 'DownRisk'])->name('risk.down');

    Route::get('/package/complate/test', [DashBoardController::class, 'ComplateTest'])->name('package.done.test');
    Route::get('/employee/history/screening/{id}', [EmployeesController::class, 'historyScreening'])->name('employee.history.screening');
    Route::get('/employee/history/test/{id}', [EmployeesController::class, 'historyTest'])->name('employee.history.test');
});




Route::prefix('employee')->as('employee.')->middleware(['CheckAuth', 'CheckRole:2', 'nocache'])->group(function () {
    Route::get('/', [DashBoardController::class, 'Employee'])->name('dash');
    Route::get('/screening', [EmployeeController::class, 'Screening'])->name('screening');
    Route::get('/add-customer', [EmployeeController::class, 'addcustomer'])->name('customeradd');
    Route::get('/package/print-bar-code/{id}', [EmployeeController::class, 'PrintBarcode'])->name('package.printbarcode');
    Route::get('/package/requested', [EmployeeController::class, 'GetRequestedPackages'])->name('package.requested');
    Route::get('/package/pending', [EmployeeController::class, 'GetPendingPackages'])->name('package.pending');
    Route::get('/package/completed', [EmployeeController::class, 'GetCompletedPackages'])->name('package.completed');
    Route::get('/package/details/{id}', [EmployeeController::class, 'PackageDetails'])->name('package.details');
    Route::get('/package/pendingdetails/{id}', [EmployeeController::class, 'PendingPackageDetails'])->name('package.pendingdetails');
    Route::get('/package/approve/{id}', [EmployeeController::class, 'ApprovePackage'])->name('package.approve');
    Route::get('/package/markpositive/{id}', [EmployeeController::class, 'SetPositive'])->name('package.markpositive');
    Route::get('/package/marknegative/{id}', [EmployeeController::class, 'SetNegative'])->name('package.marknegative');


    Route::get('/lookup', [EmployeeController::class, 'LookUp'])->name('lookup');
    Route::get('/result/download/{id}', [EmployeeController::class, 'DownloadResult'])->name('result.download');


    Route::post('/customeradd', [EmployeeController::class, 'customeraddlogic'])->name('customeraddlogic');

    Route::post('/screening/store', [EmployeeController::class, 'ScreeningStore'])->name('screening.store');
});

Route::prefix('customer')->as('customer.')->middleware(['CheckAuth', 'CheckRole:3', 'nocache'])->group(function () {
    Route::get('/', [DashBoardController::class, 'Customer'])->name('dash');
    Route::get('/request/antigen', [CustomerController::class, 'RequestAntigen'])->name('antigen');
    Route::post('/request/antigen/store', [CustomerController::class, 'AntigenStore'])->name('antigen.store');

    Route::get('/request/pcr', [CustomerController::class, 'RequestPCR'])->name('pcr');
    Route::post('/request/pcr/store', [CustomerController::class, 'PCRStore'])->name('pcr.store');

    Route::get('/results', [CustomerController::class, 'Result'])->name('results');
    Route::get('/result/download/{id}', [CustomerController::class, 'DownloadResult'])->name('result.download');
});

Route::view('URI/ss', 'mail.update-password');


Route::get('twillow', function () {
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_TOKEN");
    $twilio_number = getenv("TWILIO_FROM");

    $client = new Client($account_sid, $auth_token);

    try {
        $client->messages->create('+917056103453', [
            'from' => $twilio_number,
            'body' => 'OTP : 305624'
        ]);
    } catch (\Twilio\Exceptions\RestException $e) {
        error_log($e);
    }

    return 1;
});
