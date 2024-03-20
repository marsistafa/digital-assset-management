<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\ImageRecognitionController;
use App\Http\Livewire\CreateFolder;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
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

Route::GET('/', function () {
    if(Auth::check()){
        return view('dashboard');
    }else{
        return view('auth/login');
    }
    
});

Route::middleware('guest')->group(function () {
    Route::GET('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::POST('register', [RegisterController::class, 'store'])->name('register');
});


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::middleware(['auth.apikey'])->group(function () {

    Route::GET('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::GET('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::PATCH('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::DELETE('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::GET('/files', [FilesController::class, 'create'])->name('files.create');
    Route::GET('/myfiles', [FilesController::class, 'index'])->name('files.index');
    Route::GET('/download/{file}',[FilesController::class,'download'])->name('files.download');
    Route::GET('/preview/{file}', [FilesController::class,'preview'])->name('files.preview');
    Route::GET('/search', [SearchController::class,'search'])->name('search');
    Route::GET('/searchTag', [SearchController::class,'searchTag']);
    Route::GET('/folders', [FolderController::class,'show'])->name('folder.show');
    Route::GET('/folder', [FolderController::class,'getHierarchy'])->name('folder.getHierarchy');
    Route::POST('/edit-folder', [FolderController::class, 'editName']);
    Route::POST('/add-categories', [CategoryController::class,'store'])->name('categories.store');
    Route::PATCH('/categories-update', [CategoryController::class,'update'])->name('categories.update');
    Route::POST('/create-folder', [FolderController::class,'create'])->name('create.folder');
    Route::GET('/categories', [CategoryController::class,'index'])->name('categories.index');
    Route::GET('/create-folder', CreateFolder::class)->name('create-folder');
    Route::POST('/upload', [FilesController::class,'store']);//->middleware('optimizeImages');
    Route::POST('/analyze-image', [VisionController::class, 'analyzeImage'])->name('analyze.image');
    Route::GET('/analyze-image', [VisionController::class, 'index'])->name('analyze.index');
    Route::POST('/invoke-python-script', [ImageRecognitionController::class,'invokePythonScript'])->name('invokePythonScript');
   

});
// Route::OPTIONS('{any}', function () {
//     return response('OK', 200)
//     ->header('Access-Control-Allow-Origin', 'http://192.168.1.150:5173')
//     ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE','OPTIONS')
//     ->header('Access-Control-Allow-Headers', 'Content-Type');
// });

Route::options('/edit-folder', function () {
    return response('',200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
});

Route::options('/add-categories', function () {
    return response('',200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
});
   
require __DIR__.'/auth.php';
