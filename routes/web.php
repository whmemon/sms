<?php

use App\Http\Controllers\AccountHeadsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PlotsController;
use App\Http\Controllers\TransfersController;
use App\Http\Controllers\UsersController;
use App\Models\Transfers;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plots/index', [PlotsController::class,'index'])->name('plots.index');
Route::get('/plots/create', [PlotsController::class,'create'])->name('plots.create');
Route::post('/plots/store', [PlotsController::class,'store'])->name('plots.store');
Route::post('/plots//update', [PlotsController::class,'update'])->name('plots.update');
Route::get('/plots/{id}/edit', [PlotsController::class,'edit'])->name('plots.edit');
Route::get('/plots/search', [PlotsController::class,'search'])->name('plots.search');

Route::get('/plots/{id}/mark', [PlotsController::class,'mark'])->name('plots.mark.get');
Route::post('/plots/mark.post', [PlotsController::class,'markPost'])->name('plots.mark.post');
Route::get('/plots/members_plots', [PlotsController::class,'membersPlots'])->name('plots.members_plots');
Route::get('/plots/defaulters', [PlotsController::class,'defaulters'])->name('plots.defaulters');

Route::get('/members/index', [MembersController::class,'index'])->name('members.index');
Route::get('/members/create', [MembersController::class,'create'])->name('members.create');
Route::post('/members/store', [MembersController::class,'store'])->name('members.store');
Route::get('/members/{id}/destroy', [MembersController::class,'destroy'])->name('members.destroy');
Route::get('/members/{id}/edit', [MembersController::class,'edit'])->name('members.edit');

Route::get('/users/index', [UsersController::class,'index'])->name('users.index');
Route::get('/users/{id}/edit', [UsersController::class,'edit'])->name('users.edit');
Route::get('/users/create', [UsersController::class,'create'])->name('users.create');

Route::get('/transfers/create', [TransfersController::class,'create'])->name('transfers.create');
Route::get('/transfers/index', [TransfersController::class,'index'])->name('transfers.index');
Route::post('/transfers/store', [TransfersController::class,'store'])->name('transfers.store');


Route::get('/receivings/index', [TransfersController::class,'index'])->name('receivings.index');
Route::get('/payments/index', [TransfersController::class,'index'])->name('payments.index');

Route::get('/account-heads/index', [AccountHeadsController::class,'index'])->name('accountsheads.index');

Route::get('/transfer/{id}/pdf', [TransfersController::class,'pdf'])->name('transfer.pdf');

});

