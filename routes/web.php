<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/crateElection', [App\Http\Controllers\HomeController::class, 'crateElection'])->name('crateElection');


// staff
Route::get('/uploadDocument', [App\Http\Controllers\StaffController::class, 'uploadDocument'])->name('uploadDocument');
Route::get('/editDocument/{id}', [App\Http\Controllers\DocumentController::class, 'editDocument'])->name('editDocument');
Route::get('/viewDocument/{id}', [App\Http\Controllers\DocumentController::class, 'viewDocument'])->name('viewDocument'); //new route


Route::post('/uploadDocument', [App\Http\Controllers\DocumentController::class, 'uploadDocumentsave'])->name('uploadDocumentsave');


// Candidate
Route::post('/dataListing', [App\Http\Controllers\DataListingController::class, 'dataListing'])->name('dataListing'); //new route
Route::get('/dataListing',  [App\Http\Controllers\HomeController::class, 'index']); //new route


// Route::get('/homeCandidate', [App\Http\Controllers\CandidateController::class, 'index'])->name('homeCandidate');


// Admin
// Route::get('/homeAdmin', [App\Http\Controllers\AdminController::class, 'index'])->name('homeAdmin');

Route::get('/electionDetails', [App\Http\Controllers\AdminController::class, 'electionDetails'])->name('electionDetails');
Route::get('/candidates/{param?}', [App\Http\Controllers\AdminController::class, 'systemCandidates'])->name('systemCandidates');
Route::post('/saveCandidate', [App\Http\Controllers\AdminController::class, 'saveCandidate'])->name('saveCandidate');
Route::post('/saveUploadDocCandidate', [App\Http\Controllers\AdminController::class, 'saveUploadDocCandidate'])->name('saveUploadDocCandidate');
Route::post('/saveUploadEditDocCandidate', [App\Http\Controllers\AdminController::class, 'saveUploadEditDocCandidate'])->name('saveUploadEditDocCandidate');
Route::post('/updateCandidate', [App\Http\Controllers\AdminController::class, 'updateCandidate'])->name('updateCandidate');
Route::post('/deleteCandidate', [App\Http\Controllers\AdminController::class, 'deleteCandidate'])->name('deleteCandidate');
Route::get('/bulkDeleteTable', [App\Http\Controllers\AdminController::class, 'bulkDeleteTable'])->name('bulkDeleteTable');
Route::get('/bulkDeleteElectCan', [App\Http\Controllers\AdminController::class, 'bulkDeleteElectCan'])->name('bulkDeleteElectCan');
Route::get('/bulkDeleteElectPolticalParty', [App\Http\Controllers\AdminController::class, 'bulkDeleteElectPolticalParty'])->name('bulkDeleteElectPolticalParty');
Route::get('/bulkDeleteStaff', [App\Http\Controllers\AdminController::class, 'bulkDeleteStaff'])->name('bulkDeleteStaff');
Route::get('/bulkDelete', [App\Http\Controllers\AdminController::class, 'bulkDelete'])->name('bulkDelete');


Route::post('/getCandidate', [App\Http\Controllers\AdminController::class, 'getCandidate'])->name('getCandidate');
Route::post('/getElectionCandidate', [App\Http\Controllers\DocumentController::class, 'getElectionCandidate'])->name('getElectionCandidate'); //new route
Route::post('/getcityval', [App\Http\Controllers\InformationController::class, 'getcityval'])->name('getcityval'); //new route
Route::post('/getparroquiaval', [App\Http\Controllers\InformationController::class, 'getparroquiaval'])->name('getparroquiaval'); //new route
Route::post('/getZonaValue', [App\Http\Controllers\InformationController::class, 'getZonaValue'])->name('getZonaValue'); //new route
Route::post('/getJuntaValue', [App\Http\Controllers\InformationController::class, 'getJuntaValue'])->name('getJuntaValue'); //new route
Route::post('/updateDocument', [App\Http\Controllers\DocumentController::class, 'updateDocument'])->name('updateDocument');

// political party route here

Route::post('/savePoliticalParty', [App\Http\Controllers\PoliticalController::class, 'savePoliticalParty'])->name('savePoliticalParty');
Route::post('/deletePoliticalPparty', [App\Http\Controllers\PoliticalController::class, 'deletePoliticalPparty'])->name('deletePoliticalPparty');

// election route
Route::post('/createElection', [App\Http\Controllers\ElectionController::class, 'creatElection'])->name('creatElection');
Route::post('/addPosition', [App\Http\Controllers\ElectionController::class, 'addPosition'])->name('addPosition');

// -- Export ElectionDetails
Route::get('/export', [App\Http\Controllers\AdminController::class, 'export'])->name('export');
// -- Import ElectionDetails
Route::post('/import', [App\Http\Controllers\AdminController::class, 'importElectionDetails'])->name('importElectionDetails');


// -- Export Candidate
Route::get('/exportCandidate', [App\Http\Controllers\AdminController::class, 'exportCandidate'])->name('exportCandidate');
// -- Import Candidate
Route::post('/importCandidate', [App\Http\Controllers\AdminController::class, 'importCandidate'])->name('importCandidate');
Route::post('/importElectiontable', [App\Http\Controllers\AdminController::class, 'importElectiontable'])->name('importElectiontable');
Route::post('/importStaff', [App\Http\Controllers\AdminController::class, 'importStaff'])->name('importStaff');





// Forgot Password
Route::get('/forgotPassword', [App\Http\Controllers\InviteController::class, 'forgotPassword'])->middleware('guest')->name('forgotPassword');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->middleware('guest')->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->middleware('guest')->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->middleware('guest')->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->middleware('guest')->name('reset.password.post');

Route::get('send-mail', function () {
   
    $token = "123213213";
   
    \mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\ResetPassword($token));
   
    dd("Email is Sent.");
});


Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logoutCustom');

Route::resource('gallery',App\Http\Controllers\GalleryController::class)->middleware('auth');
Route::get('getimages',[App\Http\Controllers\GalleryController::class,'getImages']);
Route::post('image/delete',[App\Http\Controllers\GalleryController::class,'destroy']); 

// Tayab ROutes
Route::get('/tables/{id?}/{params?}', [App\Http\Controllers\InviteController::class, 'tables'])->name('tables');
Route::post('/deleteTable', [App\Http\Controllers\InviteController::class, 'deleteTable'])->name('deleteTable');
Route::post('/electionCandidateDelete', [App\Http\Controllers\electionCandidateController::class, 'electionCandidateDelete'])->name('electionCandidateDelete');
Route::post('/DocumentDelete', [App\Http\Controllers\DocumentController::class, 'DocumentDelete'])->name('DocumentDelete');
Route::get('/candidateElection/{id?}/{param?}', [App\Http\Controllers\InviteController::class, 'candidateElection'])->name('candidateElection');
Route::get('/PPElection/{id?}/{param?}', [App\Http\Controllers\InviteController::class, 'PPElection'])->name('PPElection');

Route::get('/ListData', [App\Http\Controllers\AdminController::class, 'ListData'])->name('ListData');
Route::get('/downloadDocument', [App\Http\Controllers\AdminController::class, 'documentDownload'])->name('documentDownload');
Route::get('/StaffMember/{param?}', [App\Http\Controllers\StaffController::class, 'StaffMember'])->name('StaffMember');
Route::post('/addStaffMember', [App\Http\Controllers\StaffController::class, 'addStaffMember'])->name('addStaffMember');
Route::post('/deleteStaff', [App\Http\Controllers\StaffController::class, 'deleteStaff'])->name('deleteStaff');
Route::post('/UpdateStaffMemberProfile', [App\Http\Controllers\StaffController::class, 'UpdateStaffMemberProfile'])->name('UpdateStaffMemberProfile');
Route::get('/editStaffMember', [App\Http\Controllers\StaffController::class, 'editStaffMember'])->name('editStaffMember');
Route::get('/ProfileSetting', [App\Http\Controllers\ProfileController::class, 'ProfileSetting'])->name('ProfileSetting');
Route::post('/UpdateUserProfile', [App\Http\Controllers\ProfileController::class, 'UpdateUserProfile'])->name('UpdateUserProfile');
Route::post('/ElectionMarkComplete', [App\Http\Controllers\ElectionController::class, 'ElectionMarkComplete'])->name('ElectionMarkComplete');
Route::post('/ElectionMarkProcess', [App\Http\Controllers\ElectionController::class, 'ElectionMarkProcess'])->name('ElectionMarkProcess');
Route::get('/exportElectionCandidates', [App\Http\Controllers\AdminController::class, 'exportElectionCandidates'])->name('exportElectionCandidates');
Route::get('/exportElectionPPoliticalParty', [App\Http\Controllers\AdminController::class, 'exportElectionPPoliticalParty'])->name('exportElectionPPoliticalParty');
Route::get('/exportStaffMemberfunction', [App\Http\Controllers\AdminController::class, 'exportStaffMemberfunction'])->name('exportStaffMemberfunction');
Route::post('/importElectionCandidate', [App\Http\Controllers\AdminController::class, 'importElectionCandidate'])->name('importElectionCandidate');
Route::post('/importElectionPPoliticalParty', [App\Http\Controllers\AdminController::class, 'importElectionPPoliticalParty'])->name('importElectionPPoliticalParty');
Route::post('/documents', [App\Http\Controllers\DataListingController::class, 'documentWithID'])->name('documentWithID'); //new route