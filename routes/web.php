<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('app');
// })
// ->name('application');

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin');
});

Route::get('/books', function () {
    return view('admin');
});
Route::get('/user', function () {
    return view('admin');
});
Route::get('/user/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');

Route::get('/users', function () {
    return view('admin');
});
Route::get('/users/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');

Route::get('/admin', function () {
    return view('admin');
});
Route::get('/nasabah', function () {
    return view('admin');
});
Route::get('/neraca', function () {
    return view('admin');
});
Route::get('/preview', function () {
    return view('preview');
});
Route::get('/asuransi', function () {
    return view('asuransi');
});
Route::get('/nasabah/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
Route::get('/angsuran/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
Route::get('/admin/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
Route::get('/report/{any}', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
Route::get('/input', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
Route::get('/import', function () {
    return view('admin');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api\/)(?!storage\/)[\/\w\.-]*');
