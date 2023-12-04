<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FreelancerController;
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
    return view('welcome');
});


// Routes for freelancers
Route::middleware(["AuthCheckFreelancer"])->group(function(){
    Route::get('freelancers/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancers.dashboard');
    Route::get('freelancers/logout', [FreelancerController::class, 'logout'])->name('freelancers.logout');
    
});

Route::middleware(["AlreadyLoggedFreelancer"])->group(function(){
    Route::get('freelancers/login', [FreelancerController::class, 'loginForm'])->name('freelancers.loginForm');
    Route::post('freelancers/login', [FreelancerController::class, 'login'])->name('freelancers.login');
    
});

// Register page and then actual registeration
Route::get('freelancers/register', [FreelancerController::class, 'create'])->name('freelancers.create');
Route::post('freelancers', [FreelancerController::class, 'store'])->name('freelancers.store');

Route::get('freelancers', [FreelancerController::class, 'index'])->name('freelancers.index');
// Route::get('freelancers/create', [FreelancerController::class, 'create'])->name('freelancers.create');
Route::get('freelancers/{freelancer}', [FreelancerController::class, 'show'])->name('freelancers.show');
Route::get('freelancers/{freelancer}/edit', [FreelancerController::class, 'edit'])->name('freelancers.edit');
Route::put('freelancers/{freelancer}', [FreelancerController::class, 'update'])->name('freelancers.update');
Route::delete('freelancers/{freelancer}', [FreelancerController::class, 'destroy'])->name('freelancers.destroy');


// Routes for companies
// Register page for companies and then actual registeration
Route::get('companies/register', [CompanyController::class, 'create'])->name('companies.create');
Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');

Route::middleware(["AlreadyLoggedCompany"])->group(function(){
    Route::get('companies/login', [CompanyController::class, 'loginForm'])->name('companies.loginForm');
    Route::post('companies/login', [CompanyController::class, 'login'])->name('companies.login');
    
});

Route::middleware(["AuthCheckCompany"])->group(function(){
    Route::get('companies/dashboard', [CompanyController::class, 'dashboard'])->name('companies.dashboard');
    Route::get('companies/logout', [CompanyController::class, 'logout'])->name('companies.logout');
    
});


// Routes for Admin

Route::middleware(["AlreadyLoggedAdmin"])->group(function(){
    Route::get('admin/login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');    
});

Route::middleware(["AuthCheckAdmin"])->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get("/admin/profile", function(){
        return view("admin.profile");
    })->name("admin.profile");
});

Route::get("/admin/freelancers", function(){
    return view("");
})->name("admin.freelancers.index");

Route::get("/admin/companies", function(){
    return view("");
})->name("admin.companies.index");

Route::get("/admin/finances/transactions", function(){
    return view("");
})->name("admin.finances.transactions");




