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
use App\Models\Household;
use App\Models\Link;
use App\Models\Video;
use Google\Service\CertificateAuthorityService\CertificateConfig;
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


Route::controller(AnnouncementController::class)->prefix('about')->group(function () {
    Route::get('/history', 'history')->name('History');
    Route::get('/logo', 'logo')->name('Logo');
    Route::get('/mission_vision', 'mission_vision')->name('Mission and Vision');
    Route::get('/key-officials', 'key_officials')->name('Key Officials');
    Route::get('/secretary', 'secretary')->name('The Secretary');
    Route::get('/org-structure', 'org_structure')->name('Organizational Structure');
});
Route::get('announcement/{id}', [AnnouncementController::class, 'view'])->name('announcements.view');


Route::controller(DashboardController::class)->prefix('residents')->group(function () {
    Route::get('/bonafide', 'bonafide')->name('bonafide');
    Route::get('/voters', 'voters')->name('voters');
    Route::get('/men', 'men')->name('men');
    Route::get('/women', 'women')->name('women');
    Route::get('/seniors', 'seniors')->name('seniors');
    Route::get('/womenchildren', 'womenchildren')->name('womenchildren');
    Route::get('/pregnants', 'pregnant')->name('pregnants');
    Route::get('/pwds', 'pwd')->name('pwds');
    Route::get('/inschools', 'inschools')->name('inschools');
    Route::get('/outofschools', 'outofschools')->name('outofschools');
    Route::get('/employed', 'employed')->name('employed');
    Route::get('/unemployed', 'unemployed')->name('unemployed');
    Route::get('/filipinos', 'filipinos')->name('filipinos');
    Route::get('/nonfil', 'nonfil')->name('nonfil');
    Route::get('/religion', 'religion')->name('religion');
});
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/backup', [DashboardController::class, 'backup'])->name('backup');

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/index', 'index')->name('users.index');
    Route::get('/create', 'create')->name('users.create');
    Route::post('/store', 'store')->name('users.store');
    Route::get('/edit/{id}', 'edit')->name('users.edit');
    Route::post('/update/{id}', 'update')->name('users.update');
    Route::post('/destroy/{id}', 'destroy')->name('users.destroy');
});

Route::controller(AnnouncementController::class)->prefix('announcements')->group(function () {
    Route::get('/index', 'index')->name('announcements.index');
    Route::get('/create', 'create')->name('announcements.create');
    Route::post('/store', 'store')->name('announcements.store');
    Route::get('/edit/{id}', 'edit')->name('announcements.edit');
    Route::post('/update/{id}', 'update')->name('announcements.update');
    Route::get('/destroy/{id}', 'destroy')->name('announcements.destroy');
});

Route::controller(HouseholdController::class)->prefix('households')->group(function () {
    Route::get('/create/{id}', 'create')->name('households.create');
    Route::post('/store', 'store')->name('households.store');
    Route::get('/edit/{id}', 'edit')->name('households.edit');
    Route::post('/update/{id}', 'update')->name('households.update');
    Route::get('/residents/{id}', 'residents')->name('households.residents');
    Route::get('/export', 'export')->name('households.export');
});
Route::get('households_list', [HouseholdController::class, 'list'])->name('households.list');

Route::controller(StreetController::class)->prefix('streets')->group(function () {
    Route::get('/index', 'index')->name('streets.index');
    Route::get('/households/{id}', 'households')->name('streets.households');
});

Route::controller(ResidentController::class)->prefix('residents')->group(function () {
    Route::get('/index', 'index')->name('residents.index');
    Route::get('/simplified', 'simplified')->name('residents.simplified');
    Route::get('/create/{id}', 'create')->name('residents.create');
    Route::post('/store', 'store')->name('residents.store');
    Route::get('/view/{id}', 'view')->name('residents.view');
    Route::get('/edit/{id}', 'edit')->name('residents.edit');
    Route::post('/update/{id}', 'update')->name('residents.update');
    Route::get('/archive/{id}', 'archive')->name('residents.archive');
    Route::get('/restore/{id}', 'restore')->name('residents.restore');
    Route::post('/destroy/{id}', 'destroy')->name('residents.destroy');
    Route::get('/export', 'export')->name('residents.export');
});
Route::get('archive/residents', [ResidentController::class, 'archive_index'])->name('residents.archive_index');

Route::controller(LinkController::class)->prefix('links')->group(function () {
    Route::get('/index', 'index')->name('links.index');
    Route::get('/create', 'create')->name('links.create');
    Route::post('/store', 'store')->name('links.store');
    Route::get('/edit/{id}', 'edit')->name('links.edit');
    Route::post('/update/{id}', 'update')->name('links.update');
    Route::get('/destroy/{id}', 'destroy')->name('links.destroy');
});

Route::controller(VideoController::class)->prefix('videos')->group(function () {
    Route::get('/index', 'index')->name('videos.index');
    Route::get('/create', 'create')->name('videos.create');
    Route::post('/store', 'store')->name('videos.store');
    Route::get('/edit/{id}', 'edit')->name('videos.edit');
    Route::post('/update/{id}', 'update')->name('videos.update');
    Route::get('/destroy/{id}', 'destroy')->name('videos.destroy');
});

Route::controller(CertificateController::class)->prefix('forms')->group(function () {
    Route::get('/forms', 'forms')->name('certificates.forms');
    Route::get('/indigency', 'indigency')->name('certificates.indigency');
    Route::get('/certification', 'certification')->name('certificates.certification');
    Route::get('/legal_guardian', 'legal_guardian')->name('certificates.legal_guardian');
    Route::get('/goodmoral', 'goodmoral')->name('certificates.goodmoral');
    Route::post('/indigency/pdf', 'indigencyPDF')->name('pdf.indigency');
    Route::post('/certification/pdf', 'certificationPDF')->name('pdf.certification');
    Route::post('/legal_guardian/pdf', 'legalGuardianPDF')->name('pdf.legalGuardian');
    Route::post('/goodmoral/pdf', 'goodMoralPDF')->name('pdf.goodmoral');
});
Route::get('/certificates/index', [CertificateController::class, 'index'])->name('certificates.index');

Route::view('/welcome-user', 'barangay-385.welcome-user');
