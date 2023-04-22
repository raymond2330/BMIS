<?php

use Illuminate\Support\Facades\Route;
use App\Models\Announcement;
use App\Models\Link;
use App\Models\Video;


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

Route::get('/', function () {
    $announcements = Announcement::paginate(10);
    $links = Link::all();
    $videos = Video::all();
    return view('barangay-385.index', compact('announcements', 'links', 'videos'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// CLIENT SIDE
// Route::get('barangay-385', [App\Http\Controllers\AnnouncementController::class, 'barangay'])->name('Home');
Route::get('announcement/{id}', [App\Http\Controllers\AnnouncementController::class, 'view'])->name('announcements.view');
Route::get('about/history', [App\Http\Controllers\AnnouncementController::class, 'history'])->name('History');
Route::get('about/logo', [App\Http\Controllers\AnnouncementController::class, 'logo'])->name('Logo');
Route::get('about/mission_vision', [App\Http\Controllers\AnnouncementController::class, 'mission_vision'])->name('Mission and Vision');
Route::get('about/key-officials', [App\Http\Controllers\AnnouncementController::class, 'key_officials'])->name('Key Officials');
Route::get('about/secretary', [App\Http\Controllers\AnnouncementController::class, 'secretary'])->name('The Secretary');
Route::get('about/org-structure', [App\Http\Controllers\AnnouncementController::class, 'org_structure'])->name('Organizational Structure');
// CLIENT SIDE

// SERVER SIDE
// Route::get('/admin-panel', [App\Http\Controllers\AnnouncementController::class, 'admin_panel'])->name('admin');
// SERVER SIDE

// CRUD FUNCTIONALITIES FOR ANNOUNCEMENTS
Route::get('announcements/index', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('announcements/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('announcements/store', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('announcements/edit/{id}', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('announcements.edit');
Route::post('announcements/update/{id}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('announcements.update');
Route::get('announcements/destroy/{id}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('announcements.destroy');
// CRUD FUNCTIONALITIES FOR ANNOUNCEMENTS

// CRUD FUNCTIONALITIES FOR HOUSEHOLD PROFILING
// Route::get('households/index', [App\Http\Controllers\HouseholdController::class, 'index'])->name('households.index');
Route::get('households/index_test', [App\Http\Controllers\HouseholdController::class, 'test_index'])->name('households.index_test');
Route::get('households/households_list/{street}', [App\Http\Controllers\HouseholdController::class, 'households'])->name('households.households');
Route::get('households/create/{id}', [App\Http\Controllers\HouseholdController::class, 'create'])->name('households.create');
Route::post('households/store', [App\Http\Controllers\HouseholdController::class, 'store'])->name('households.store');
Route::get('households/edit/{id}', [App\Http\Controllers\HouseholdController::class, 'edit'])->name('households.edit');
Route::post('households/update/{id}', [App\Http\Controllers\HouseholdController::class, 'update'])->name('households.update');
Route::get('households/create_resident/{id}', [App\Http\Controllers\HouseholdController::class, 'create_resident'])->name('households.create_resident');
Route::get('households/residents/{full_address}', [App\Http\Controllers\HouseholdController::class, 'residents'])->name('households.residents');
// CRUD FUNCTIONALITIES FOR HOUSEHOLD PROFILING

// CRUD FUNCTIONALITIES FOR RESIDENT PROFILING
Route::get('residents/index/', [App\Http\Controllers\ResidentController::class, 'index'])->name('residents.index');
Route::post('residents/store', [App\Http\Controllers\ResidentController::class, 'store'])->name('residents.store');
Route::get('residents/view/{id}', [App\Http\Controllers\ResidentController::class, 'view'])->name('residents.view');
Route::get('residents/edit/{id}', [App\Http\Controllers\ResidentController::class, 'edit'])->name('residents.edit');
Route::post('residents/update/{id}', [App\Http\Controllers\ResidentController::class, 'update'])->name('residents.update');
// CRUD FUNCTIONALITIES FOR RESIDENT PROFILING

// CRUD FUNCTIONALITIES FOR QUICK LINKS
Route::get('links/index', [App\Http\Controllers\LinkController::class, 'index'])->name('links.index');
Route::get('links/create', [App\Http\Controllers\LinkController::class, 'create'])->name('links.create');
Route::post('links/store', [App\Http\Controllers\LinkController::class, 'store'])->name('links.store');
Route::get('links/edit/{id}', [App\Http\Controllers\LinkController::class, 'edit'])->name('links.edit');
Route::post('links/update/{id}', [App\Http\Controllers\LinkController::class, 'update'])->name('links.update');
Route::get('links/destroy/{id}', [App\Http\Controllers\LinkController::class, 'destroy'])->name('links.destroy');
// CRUD FUNCTIONALITIES FOR QUICK LINKS

// CRUD FUNCTIONALITIES FOR FEATURED VIDEOS
Route::get('videos/index', [App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('videos/create', [App\Http\Controllers\VideoController::class, 'create'])->name('videos.create');
Route::post('videos/store', [App\Http\Controllers\VideoController::class, 'store'])->name('videos.store');
Route::get('videos/edit/{id}', [App\Http\Controllers\VideoController::class, 'edit'])->name('videos.edit');
Route::post('videos/update/{id}', [App\Http\Controllers\VideoController::class, 'update'])->name('videos.update');
Route::get('videos/destroy/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('videos.destroy');
// CRUD FUNCTIONALITIES FOR FEATURED VIDEOS


// DASHBOARD
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
// DASHBOARD

// CLEARANCES
Route::get('/certificates/indigency', [App\Http\Controllers\CertificateController::class, 'indigency'])->name('certificates.indigency');
Route::get('/certificates/certification', [App\Http\Controllers\CertificateController::class, 'certification'])->name('certificates.certification');
Route::get('/certificates/legal_guardian', [App\Http\Controllers\CertificateController::class, 'legal_guardian'])->name('certificates.legal_guardian');


Route::post('/certificates/indigency/pdf', [App\Http\Controllers\CertificateController::class, 'indigencyPDF'])->name('pdf.indigency');
Route::post('/certificates/certification/pdf', [App\Http\Controllers\CertificateController::class, 'certificationPDF'])->name('pdf.certification');
Route::post('/certificates/legal_guardian/pdf', [App\Http\Controllers\CertificateController::class, 'legalGuardianPDF'])->name('pdf.legalGuardian');




// CLEARANCES
