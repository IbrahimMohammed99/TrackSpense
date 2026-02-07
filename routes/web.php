<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\IncomeController;
use \App\Http\Controllers\ExpenseController;
use \App\Http\Controllers\DashboardController;
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


Route::get('/', [DashboardController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->name('categories.')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->name('incomes.')->prefix('incomes')->group(function () {
    Route::get('/', [IncomeController::class, 'index'])->name('index');
    Route::get('/show', [IncomeController::class, 'show'])->name('show');
    Route::get('/create', [IncomeController::class, 'create'])->name('create');
    Route::post('/store', [IncomeController::class, 'store'])->name('store');
    Route::get('/edit/{income}', [IncomeController::class, 'edit'])->name('edit');
    Route::put('/update/{income}', [IncomeController::class, 'update'])->name('update');
    Route::delete('/destroy/{income}', [IncomeController::class, 'destroy'])->name('destroy');
    Route::get('/{income}/expenses', [IncomeController::class, 'showExpensesForMonth'])->name('expenses');
});

Route::middleware(['auth', 'verified'])->name('expenses.')->prefix('expenses')->group(function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
    Route::get('/show', [ExpenseController::class, 'show'])->name('show');
    Route::get('/create', [ExpenseController::class, 'create'])->name('create');
    Route::post('/store', [ExpenseController::class, 'store'])->name('store');
    Route::get('/edit/{expense}', [ExpenseController::class, 'edit'])->name('edit');
    Route::put('/update/{expense}', [ExpenseController::class, 'update'])->name('update');
    Route::delete('/destroy/{expense}', [ExpenseController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'verified'])->name('statistics.')->prefix('statistics')->group(function () {
    Route::get('/daily-average', [StatisticsController::class, 'dailyAverage'])->name('dailyAverage');
    Route::get('/category-totals', [StatisticsController::class, 'categoryTotals'])->name('categoryTotals');
    Route::get('/statistics/daily', [StatisticsController::class, 'dailyChart'])->name('daily');

});

Route::middleware(['auth', 'verified'])->name('user-settings.')->prefix('user-settings')->group(function () {
    Route::get('/profile', [StatisticsController::class, 'profile'])->name('profile');
    Route::put('/profile', [StatisticsController::class, 'update'])->name('update-profile');
});


Route::middleware(['auth', 'verified'])->get('/contact', function () {
    return view('contact');
})->name('contact');


Route::middleware(['auth', 'verified'])->post('/contact', function () {
    return redirect()
        ->route('contact')
        ->with('success', 'Your message has been sent successfully!');
})->name('contact.send');



require __DIR__ . '/auth.php';
