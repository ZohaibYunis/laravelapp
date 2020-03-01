<?php

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

//Route::get('/', function () {
//    return view('welcome');
//})->name('welcome');
//todo make site index after login back button setting
Route::get('/', function () {
    //return view('auth.login');
    return redirect()->route('login');
})->name('welcome');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//ajax Routes//
Route::get('/cities/{id}','Auth\RegisterController@all_cities');

//Admin Routes//
Route::get('catsadmin','Auth\AdminLoginController@showLoginForm')->name('catsAdmLogin');
Route::resource('ContestCategory','Admin\ContestController');

Route::get('getAllInsitutes','Admin\ContestInformation@index')->name('viewAllInstitutes');
Route::get('getAllRegStudents','Admin\ContestInformation@view_all_students_info')->name('ViewAllRegStudents');
Route::get('getInstStudentsInfo/{id}/show','Admin\ContestInformation@view_contest_student_info')->name('viewInstStudentInfo');
Route::get('getInstAllStudentsInfo/{id}/show','Admin\ContestInformation@view_previous_student_info')->name('viewAllInstStudentInfo');
Route::get('EditInstStudentInfo/{id}/{ins_id}/show','Admin\ContestInformation@edit_student_info_form')->name('editInstStudentInfoAdm');
Route::post('UpdateInstStudentInfo/{id}/{ins_id}','Admin\ContestInformation@update_inst_student_info')->name('updateInstStudentInfoAdm');
Route::patch('DeleteInstitute/{id}','Admin\ContestInformation@update_insititute_status')->name('deleteInst');
Route::get('ViewAllInActiveInst','Admin\ContestInformation@view_in_active_inst')->name('viewAllInActiveInst');
Route::patch('UpdateInstStatus/{id}','Admin\ContestInformation@active_inst_status')->name('UpdateInstStatus');

Route::get('EditInstituteInfo/{id}/edit','Admin\ContestInformation@edit_insititute_info')->name('editInstInfoAdm');
Route::post('UpdateInstituteInfo/{id}','Admin\ContestInformation@update_insititute_info')->name('updateInstInfoAdm');
Route::get('getPaymentFile/{id}/show','Admin\ContestInformation@view_institute_wise_payments')->name('viewPaymentFile');
Route::get('getAllCoordinators','Admin\ContestInformation@view_all_coordinators_institute_wise')->name('viewAllCoordinators');
Route::post('getCoordinatorsByDate','Admin\ContestInformation@get_all_coordinators_by_date')->name('viewCoordinatorsByDate');
Route::get('EditCoordinatorInfo/{id}/edit','Admin\ContestInformation@edit_coordinators_info')->name('editCoorInfoAdm');
Route::patch('UpdateCoordinatorInfo/{id}','Admin\ContestInformation@update_coordinators_info')->name('updateCoordinatorsInfoAdm');
Route::get('getAllAddiCoordinators','Admin\ContestInformation@view_all_additional_coordinators')->name('viewAllAddiCoordinators');
Route::get('EditAdditionalCoordinatorInfo/{id}/edit','Admin\ContestInformation@edit_addi_coordinators_info')->name('editAddiCoorInfoAdm');
Route::patch('UpdateAdditionalCoordinatorInfo/{id}','Admin\ContestInformation@update_addi_coordinator_info')->name('updateAddiCoordinatorsInfoAdm');
Route::post('AddAdditionalCoordinatorsAdm','Admin\ContestInformation@add_additional_coordinators')->name('ContestAdm.addAddiCoor');







//Application Functionaity  Routes

/*************Coordinator Starts***************/
Route::resource('ContestCoordinators','Coordinators\ContestCoordinatorsController');
Route::get('SelectContestView','Coordinators\ContestCoordinatorsController@select_contest_participate_view')->name('contestSelectionView');
Route::post('SelectContest','Coordinators\ContestCoordinatorsController@select_contest_participate')->name('contestSelection');
Route::get('AddCoordinator','Coordinators\ContestCoordinatorsController@show_single_coordinator_view')->name('AddSingleCoordinator1');
Route::get('AddCoordinatorCat','Coordinators\ContestCoordinatorsController@show_single_second_coord_view')->name('AddSingleCoordinator2');
Route::post('CreateCoordinator','Coordinators\ContestCoordinatorsController@add_single_coordinator')->name('AddSingleCoordinator');
Route::resource('ContestAdditionalCoordinators','Coordinators\AddtionalCoordinatorsController');


/*************Coordinator End***************/


/*************Contest Strength Starts***************/
Route::resource('ContestStudentStrength','ContestStudents\ContestStudentStrengthControler');
Route::post('AddMoreStudentStrength','ContestStudents\ContestStudentStrengthControler@add_more_student_strength')->name('addMoreStudents');
/*************Contest Strength End***************/

/*************Contest Student Information Starts ***************/

Route::get('ContestStudentInformation','ContestStudents\ContestStudentsController@index')->name('dashboardCurrStudentInfo');
Route::get('AddContestStudentInformation','ContestStudents\ContestStudentsController@create_contest_students_form')->name('addStudentInfoForm');
Route::post('AddContestStudentInformation','ContestStudents\ContestStudentsController@store_contest_students_info')->name('storeStudentInfo');
Route::get('EditContestStudentInformation/{id}/edit','ContestStudents\ContestStudentsController@edit_student_info')->name('editStudentInfo');
Route::post('UpdateContestStudentInformation/{id}','ContestStudents\ContestStudentsController@update_student_info')->name('updateStudentInfo');
Route::post('UpdateCurrentStdRegStatus','ContestStudents\ContestStudentsController@update_registration_status')->name('updateCurrentStdRegStatus');
Route::get('EditInstituteInfo','ContestStudents\ContestStudentsController@edit_inst_info_form')->name('editInstInfo');
Route::post('UpdateInstituteInfo','ContestStudents\ContestStudentsController@update_inst_form')->name('updateInstInfo');
Route::post('AddPayment','ContestStudents\ContestStudentsController@upload_and_store_payment_file')->name('UploadPaymentFile');

/*************Contest Student Information  End ***************/


/*****Cache-Clear***********/
Route::get('/ClearCache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo "Cache Cleared ";
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    echo '<h1>Clear Config cleared</h1>';
});
Route::get('/ViewCache', function() {
    $exitCode = Artisan::call('view:clear');
    echo "Site Down";
});





