<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchieveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionsController::class);
Route::resource('products', ProductsController::class);
Route::resource('archieve' , ArchieveController::class);
Route::resource('dashboard' , HomeController::class);
//Route::resource('users', UserController::class);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('invoices.Invoice_Paid' , [InvoicesController::class,'Invoice_Paid']);
Route::get('invoices.Invoice_Unpaid' , [InvoicesController::class,'Invoice_Unpaid']);
Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Auth::routes(['register' =>true]);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/{page}', [AdminController::class,'index']);
Route::get('/section/{id}' , [InvoicesController::class , 'getproducts']);
Route::get('/edit_invoice/{id}' , [InvoicesController::class , 'edit']);
Route::get('/status_show/{id}',[InvoicesController::class , 'show']);
Route::get('/delete_invoice/{id}' , [InvoicesController::class , 'destroy']);
Route::get('/forceDelete_invoice/{id}' , [InvoicesController::class , 'delete']);

Route::get('/Invoice_Paid' , [InvoicesController::class , 'Invoice_Paid']);
Route::post('/Status_Update/{id}', [InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::get('/archieve_move/{id}' , [ArchieveController::class,'store']);
Route::get('/move_to_invoice/{id}' , [InvoicesController::class,'restore']);




Route::get('/invoicesDetails/{id}' , [InvoicesDetailsController::class , 'edit']);

Route::resource('InvoiceAttachments' , InvoicesAttachmentsController::class);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);

Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');
require __DIR__.'/auth.php';
