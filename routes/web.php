<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\GigController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Models\Category;
use App\Models\Freelancer;
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
Route::get('/test', function () {
    return view('test');
});

Route::middleware(["PassCompanyData"])->group(function() {
    Route::get('/', [PublicController::class, "home"])->name("public.home");
    Route::get('/gigs', [PublicController::class, "search"])->name("public.search");
    Route::get('/{id}/gig', [GigController::class, "show"])->name("public.gig.show");
    Route::get('/{id}/freelancer', [FreelancerController::class, "show"])->name("public.freelancer.show");
    Route::get('/{id}/company', [FreelancerController::class, "show"])->name("public.company.show");
    Route::get('/team', [PublicController::class, "team"])->name("public.team");
});

Route::prefix("orders")->group(function(){
    Route::middleware(["AuthCheckCompany"])->group(function(){

        Route::get('create/{gigId}', [OrderController::class, 'create'])->name('orders.create');
        Route::post('create', [OrderController::class, 'store'])->name('orders.store');

    });
});

// Routes for freelancers    
Route::prefix("freelancers")->group(function(){
    Route::middleware(["AlreadyLoggedFreelancer"])->group(function(){
        Route::get('/login', [FreelancerController::class, 'loginForm'])->name('freelancers.loginForm');
        Route::post('login', [FreelancerController::class, 'login'])->name('freelancers.login');
    });
    // Register page and then actual registeration
    Route::get('register', [FreelancerController::class, 'create'])->name('freelancers.create');
    Route::post('freelancers', [FreelancerController::class, 'store'])->name('freelancers.store');
    
    Route::middleware(["AuthCheckFreelancer"])->group(function(){
        Route::get('dashboard', [FreelancerController::class, 'dashboard'])->name('freelancers.dashboard');
        Route::get('logout', [FreelancerController::class, 'logout'])->name('freelancers.logout');
        Route::get('profile', [FreelancerController::class, 'profilePage'])->name('freelancers.profile');
        Route::put('{id}', [FreelancerController::class, 'update'])->name('freelancers.update');

        Route::prefix("gigs")->group(function(){
            Route::get('gigs', [GigController::class, 'gigsDashboard'])->name('freelancers.gigs.index');
            Route::get('create', [GigController::class, 'create'])->name('freelancers.gigs.create');
            Route::post('create', [GigController::class, 'store'])->name('freelancers.gigs.store');
            Route::get('{gig}/edit', [GigController::class, 'edit'])->name('freelancers.gigs.edit');
            Route::put('{gig}', [GigController::class, 'update'])->name('freelancers.gigs.update');            
            Route::delete('{gig}', [GigController::class, 'destroy'])->name('freelancers.gigs.destroy');
            Route::put('{gig}/update-status', [GigController::class, 'updateStatus'])->name("freelancers.gigs.updateStatus");
        });

        Route::prefix("finances")->group(function(){
            Route::get("finances", [FreelancerController::class, 'financesDashboard'])->name("freelancers.finances.index");         
            Route::get("withdraw", [FreelancerController::class, 'withdrawPage'])->name("freelancers.finances.withdraw");
            Route::post("withdraw", [FreelancerController::class, 'withdrawCash'])->name("freelancers.finances.withdrawCash");
        });
        
        
        Route::prefix("bank-account")->group(function(){
            Route::put("{id}/update", [BankAccountsController::class, 'updateFreelancer'])->name("freelancers.bank_account.update");
        });
        
    });

});

// Routes for companies
Route::prefix("companies")->group(function(){

    Route::get('register', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');
    
    Route::middleware(["AlreadyLoggedCompany"])->group(function(){
        Route::get('login', [CompanyController::class, 'loginForm'])->name('companies.loginForm');
        Route::post('login', [CompanyController::class, 'login'])->name('companies.login');
    });

    Route::middleware(["AuthCheckCompany"])->group(function(){
        Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('companies.dashboard');
        Route::get('logout', [CompanyController::class, 'logout'])->name('companies.logout'); 
        Route::get('profile', [CompanyController::class, 'profilePage'])->name('companies.profile');
        Route::put('{id}', [CompanyController::class, 'update'])->name('companies.update');

        Route::prefix("orders")->group(function(){
            Route::get('/orders', [OrderController::class, 'index'])->name('companies.orders.index');
            Route::get('/{id}', [OrderController::class, "show"])->name("companies.orders.show");
            Route::delete('/{id}', [OrderController::class, "destroy"])->name("companies.orders.destroy");
            Route::put('/{order}/update-status/{newStatus}', [OrderController::class, 'updateStatus'])->name("companies.orders.updateStatus");
        });

        Route::prefix("finances")->group(function(){
            Route::get("finances", [CompanyController::class, 'financesDashboard'])->name("companies.finances.index");
            Route::get("deposit", [CompanyController::class, 'depositPage'])->name("companies.finances.deposit");
            Route::post("deposit", [CompanyController::class, 'depositCash'])->name("companies.finances.depositCash");
            Route::get("withdraw", [CompanyController::class, 'withdrawPage'])->name("companies.finances.withdraw");
            Route::post("withdraw", [CompanyController::class, 'withdrawCash'])->name("companies.finances.withdrawCash");  
        });

        Route::prefix("bank-account")->group(function(){
            Route::put("{id}/update", [BankAccountsController::class, 'updateCompany'])->name("companies.bank_account.update");
        });

    });

});

// Routes for Admin
Route::prefix("admin")->group(function(){

    Route::middleware(["AlreadyLoggedAdmin"])->group(function(){
        Route::get('login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
        Route::post('login', [AdminController::class, 'login'])->name('admin.login');    
    });
    
    Route::middleware(["AuthCheckAdmin"])->group(function(){
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('profile', [AdminController::class, 'profilePage'])->name('admin.profile');
        Route::put('{id}', [AdminController::class, 'update'])->name('admin.update');

        Route::prefix("freelancers")->group(function(){
            Route::get("/", [AdminController::class, 'freelancerDashboard'])->name("admin.freelancers.index");
        });
        
        Route::prefix("companies")->group(function(){
            Route::get("/", [AdminController::class, 'companiesDashboard'])->name("admin.companies.index");
        });

        // Finances Routes
        Route::prefix("finances")->group(function(){
            Route::get("finances", [AdminController::class, 'financesDashboard'])->name("admin.finances.index");
            Route::get("deposit", [AdminController::class, 'depositPage'])->name("admin.finances.deposit");
            Route::post("deposit", [AdminController::class, 'depositCash'])->name("admin.finances.depositCash");
            Route::get("withdraw", [AdminController::class, 'withdrawPage'])->name("admin.finances.withdraw");
            Route::post("withdraw", [AdminController::class, 'withdrawCash'])->name("admin.finances.withdrawCash");    
        });

        Route::prefix("bank-account")->group(function(){
            Route::put("{id}/update", [BankAccountsController::class, 'updateAdmin'])->name("admin.bank_account.update");
        });

    });
    
    Route::get("/admin/finances/transactions", function(){
        return view("");
    })->name("admin.finances.transactions");
    
});





