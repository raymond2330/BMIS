<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Models\Announcement;
use App\Models\Link;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


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
Route::controller(AnnouncementController::class)->group(function () {
    Route::get('announcement/{id}', 'view')->name('announcements.view');
    Route::get('about/history', 'history')->name('History');
    Route::get('about/logo', 'logo')->name('Logo');
    Route::get('about/mission_vision', 'mission_vision')->name('Mission and Vision');
    Route::get('about/key-officials', 'key_officials')->name('Key Officials');
    Route::get('about/secretary', 'secretary')->name('The Secretary');
    Route::get('about/org-structure', 'org_structure')->name('Organizational Structure');
});



//DASHBOARD
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('residents/bonafide', 'bonafide')->name('bonafide');
    Route::get('residents/voters', 'voters')->name('voters');
    Route::get('residents/men', 'men')->name('men');
    Route::get('residents/women', 'women')->name('women');
    Route::get('residents/seniors', 'seniors')->name('seniors');
    Route::get('residents/womenchildren', 'womenchildren')->name('womenchildren');
    Route::get('residents/pregnants', 'pregnant')->name('pregnants');
    Route::get('residents/pwds', 'pwd')->name('pwds');
    Route::get('residents/inschools', 'inschools')->name('inschools');
    Route::get('residents/outofschools', 'outofschools')->name('outofschools');
    Route::get('residents/employed', 'employed')->name('employed');
    Route::get('residents/unemployed', 'unemployed')->name('unemployed');
    Route::get('residents/filipinos', 'filipinos')->name('filipinos');
    Route::get('residents/nonfil', 'nonfil')->name('nonfil');
    Route::get('residents/religion', 'religion')->name('religion');
    Route::get('/backup', 'backup')->name('backup');
    // Route::get('/test', 'test')->name('test');

});

//CRUD FUNCTIONALITIES FOR USERS
Route::controller(UserController::class)->group(function () {
    Route::get('users/index', 'index')->name('users.index');
    Route::get('users/create', 'create')->name('users.create');
    Route::post('users/store', 'store')->name('users.store');
    Route::get('users/edit/{id}', 'edit')->name('users.edit');
    Route::post('users/update/{id}', 'update')->name('users.update');
    Route::post('users/destroy/{id}', 'destroy')->name('users.destroy');
});

// CRUD FUNCTIONALITIES FOR ANNOUNCEMENTS
Route::controller(AnnouncementController::class)->group(function () {
    Route::get('announcements/index', 'index')->name('announcements.index');
    Route::get('announcements/create', 'create')->name('announcements.create');
    Route::post('announcements/store', 'store')->name('announcements.store');
    Route::get('announcements/edit/{id}', 'edit')->name('announcements.edit');
    Route::post('announcements/update/{id}', 'update')->name('announcements.update');
    Route::get('announcements/destroy/{id}', 'destroy')->name('announcements.destroy');
});


// CRUD FUNCTIONALITIES FOR HOUSEHOLD PROFILING
Route::controller(HouseholdController::class)->group(function () {
    Route::get('households_list', 'list')->name('households.list');
    Route::get('households/create/{id}', 'create')->name('households.create');
    Route::post('households/store', 'store')->name('households.store');
    Route::get('households/edit/{id}', 'edit')->name('households.edit');
    Route::post('households/update/{id}', 'update')->name('households.update');
    Route::get('households/residents/{id}', 'residents')->name('households.residents');
    Route::get('households/export', 'export')->name('households.export');

});

// CRUD FUNCTIONALITIES FOR HOUSEHOLD PROFILING
Route::controller(StreetController::class)->group(function () {
    Route::get('streets/index', 'index')->name('streets.index');
    Route::get('/streets/households/{id}', 'households')->name('streets.households');
});

// CRUD FUNCTIONALITIES FOR RESIDENT PROFILING
Route::controller(ResidentController::class)->group(function () {
    Route::get('residents/index/', 'index')->name('residents.index');
    Route::get('residents/simplified/', 'simplified')->name('residents.simplified');
    Route::get('residents/create/{id}', 'create')->name('residents.create');
    Route::post('residents/store', 'store')->name('residents.store');
    Route::get('residents/view/{id}', 'view')->name('residents.view');
    Route::get('residents/edit/{id}', 'edit')->name('residents.edit');
    Route::post('residents/update/{id}', 'update')->name('residents.update');
    Route::get('residents/archive/{id}', 'archive')->name('residents.archive');
    Route::get('archive/residents', 'archive_index')->name('residents.archive_index');
    Route::get('residents/restore/{id}', 'restore')->name('residents.restore');
    Route::post('residents/destroy/{id}', 'destroy')->name('residents.destroy');
    Route::get('residents/export', 'export')->name('residents.export');
});

// CRUD FUNCTIONALITIES FOR QUICK LINKS
Route::controller(LinkController::class)->group(function () {
    Route::get('links/index', 'index')->name('links.index');
    Route::get('links/create', 'create')->name('links.create');
    Route::post('links/store', 'store')->name('links.store');
    Route::get('links/edit/{id}', 'edit')->name('links.edit');
    Route::post('links/update/{id}', 'update')->name('links.update');
    Route::get('links/destroy/{id}', 'destroy')->name('links.destroy');
});

// CRUD FUNCTIONALITIES FOR FEATURED VIDEOS
Route::controller(VideoController::class)->group(function () {
    Route::get('videos/index', 'index')->name('videos.index');
    Route::get('videos/create', 'create')->name('videos.create');
    Route::post('videos/store', 'store')->name('videos.store');
    Route::get('videos/edit/{id}', 'edit')->name('videos.edit');
    Route::post('videos/update/{id}', 'update')->name('videos.update');
    Route::get('videos/destroy/{id}', 'destroy')->name('videos.destroy');
});

Route::controller(CertificateController::class)->group(function () {
    // CRUD FUNCTIONALITIES
    Route::get('/certificates/index', 'index')->name('certificates.index');
    Route::get('/forms', 'forms')->name('certificates.forms');

    // FORMS PAGE
    Route::get('/forms/indigency', 'indigency')->name('certificates.indigency');
    Route::get('/forms/certification', 'certification')->name('certificates.certification');
    Route::get('/forms/legal_guardian', 'legal_guardian')->name('certificates.legal_guardian');
    Route::get('/forms/goodmoral', 'goodmoral')->name('certificates.goodmoral');

    //PDF FOR FORMS
    Route::post('/forms/indigency/pdf', 'indigencyPDF')->name('pdf.indigency');
    Route::post('/forms/certification/pdf', 'certificationPDF')->name('pdf.certification');
    Route::post('/forms/legal_guardian/pdf', 'legalGuardianPDF')->name('pdf.legalGuardian');
    Route::post('/forms/goodmoral/pdf', 'goodMoralPDF')->name('pdf.goodmoral');
});

Route::view('/welcome-user', 'barangay-385.welcome-user');
