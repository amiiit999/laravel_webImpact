<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\user\UserDashboardController;

use App\Http\Controllers\admin\UserController;
use App\Models\User;
use \Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    if (Auth::guard('web')->user()) {
        if (Auth::guard('web')->user()->isAdministrator() || Auth::guard('web')->user()->isAdmin())
            return redirect(route('admin.dashboard.index'));
        else
            return redirect(route('user.dashboard.index'));
    }
    return view('welcome');
});



#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    if (Auth::guard('web')->user()) {
        if (Auth::guard('web')->user()->isAdministrator() || Auth::guard('web')->user()->isAdmin())
            return redirect(route('admin.dashboard.index'));
        else
            return redirect(route('user.dashboard.index'));
    } else {
        return redirect('login');
    }
})->name('home');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.dashboard.index'));
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users',UserController::class);
    Route::get('getUser', function (Request $request) {
        if ($request->ajax()) {
                $data = User::latest()->get();
               
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="' . route('admin.users.show', $row->id) .'" class="view btn btn-dark btn-sm">View</a> <a href="' . route('admin.users.edit', $row->id) .'" class="edit btn btn-success btn-sm">Edit</a><a href="' . route('admin.user.dropzone', $row->id) .'" class="update btn btn-primary btn-sm text-light ms-1"> Upload Image</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
    })->name('user.index'); 
   
    Route::get('dropzone/{id}', [UserController::class, 'dropzone'])->name('user.dropzone');
   
    Route::post('dropzone/store/{id}', [UserController::class, 'dropzoneStore'])->name('user.dropzone.store');
    
});

Route::prefix('users')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect(route('user.dashboard.index'));
    });
   
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
});


Auth::routes();

#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
