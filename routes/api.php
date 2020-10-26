<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api-header'], function () {
    // The registration and login requests doesn't come with tokens
    // as users at that point have not been authenticated yet
    // Therefore the jwtMiddleware will be exclusive of them

    // Meeting
    Route::post('/create_meeting','MeetingController@createMeeting');
    Route::get('/retrieve_meetings','MeetingController@retrieveMeetings');
    Route::get('/retrieve_limited_meeting/{id}','MeetingController@retrieveLimitedMeeting');
    Route::post('/update_meeting','MeetingController@updateMeeting');
    Route::get('/retrieve_meeting_now','MeetingController@retrieveMeetingByCurrentDate');
    Route::post('/delete_meeting/{id}','MeetingController@deleteMeeting');

    // Ticket
    Route::post('/create_ticket','TicketController@createTicket');
    Route::post('/update_ticket','TicketController@updateTicket');
    Route::get('/retrieve_tickets','TicketController@retrieveTickets');
    Route::get('/retrieve_tickets_by_year/{year}','TicketController@retrieveTicketsByYear');
    Route::get('/retrieve_tickets_by_month/{month}','TicketController@retrieveTicketsByMonth');
    Route::get('/retrieve_tickets_by_date','TicketController@retrieveTicketsByDate');
    Route::post('/delete_ticket','TicketController@deleteTicket');
    Route::post('/close_ticket','TicketController@closeTicketRequest');
    Route::get('/retrieve_tickets_by_status/{status}','TicketController@retrieveTicketsByStatus');
    Route::get('/retrieve_tickets_by_employee/{id}','TicketController@retrieveTicketsByEmployee');

    // Login
    Route::post('/login', 'AuthController@login');

    // File upload
    Route::get('/image/{folder}/{file}','FileController@serve');
    // Route::post('/upload','FileController@store');
    // Route::get('/retrieveLimitedFiles/{id}','FileController@retrieveLimitedFile');
    Route::post('/add_file','FileController@addFile');
    Route::get('/retrieve_files','FileController@retrieveFiles');
    Route::get('/retrieve_files_by_type/{id}','FileController@retrieveFilesByType');
    Route::post('/delete_file/{id}','FileController@deleteFile');
    Route::post('/update_file','FileController@updateFile');
    Route::get('/image/{filename}','FileController@serveImage');

    // Employee
    Route::post('/create_employee', 'EmployeeController@createEmployee');
    Route::get('/retrieve_employees','EmployeeController@retrieveEmployees');
    Route::get('/retrieve_limited_employee/{id}','EmployeeController@retrieveLimitedEmployee');
    Route::get('/retrieve_employee_by_department/{id}','EmployeeController@retrieveEmployeeByDepartment');
    Route::get('/retrieve_employee_by_manager/{id}','EmployeeController@retrieveEmployeeByManager');
    Route::post('/delete_employee/{id}','EmployeeController@deleteEmployee');
    Route::post('/update_employee','EmployeeController@updateEmployee');
    Route::post('/update_profile/img','EmployeeController@updateProfilePicture');
    Route::post('/retrieve_employee_profile','EmployeeController@retrieveEmployeeProfile');

    // Department
    Route::post('/add_department', 'DepartmentController@addDepartment'); // in adding the department, dept_head also added
    Route::post('/delete_department', 'DepartmentController@deleteDepartment');
    Route::post('/update_department', 'DepartmentController@updateDepartment');
    Route::get('/retrieve_limited_department/{id}', 'DepartmentController@retrieveLimitedDepartment');
    Route::get('/retrieve_departments', 'DepartmentController@retrieveDepartments');
    Route::get('/retrieve_department_heads_v1', 'DepartmentController@retrieveDepartmentHeads');
    Route::post('/retrieve_departments_managers_v1', 'DepartmentController@retrieveDepartmentManagers');


    // Department Employee
    Route::post('/add_department_employee', 'DepartmentEmployeeController@addDepartmentEmployee');
    Route::post('/delete_department_employee', 'DepartmentEmployeeController@deleteDepartmentEmployee');
    Route::get('/retrieve_limited_department_employee/{id}', 'DepartmentEmployeeController@retrieveLimitedDepartmentEmployee');
    Route::get('/retrieve_department_employees', 'DepartmentEmployeeController@retrieveDepartmentEmployees');
    Route::post('/update_department_employee', 'DepartmentEmployeeController@updateDepartmentEmployee');

    // Department Manager
    Route::post('/add_department_manager', 'DepartmentManagerController@addDepartmentManager');
    Route::get('/retrieve_department_managers', 'DepartmentManagerController@retrieveDepartmentManagers');
    Route::get('/retrieve_limited_department_manager/{id}', 'DepartmentManagerController@retrieveLimitedDepartmentManager');
    Route::post('/update_department_manager', 'DepartmentManagerController@updateDepartmentManager');
    Route::post('/delete_department_manager', 'DepartmentManagerController@deleteDepartmentManager');

    // Department Head
    Route::post('/update_department_head', 'DepartmentHeadController@updateDepartmentHead');
    Route::get('/retrieve_department_heads', 'DepartmentHeadController@retrieveDepartmentHeads');
    Route::get('/retrieve_limited_department_head/{id}', 'DepartmentHeadController@retrieveLimitedDepartmentHead');
    Route::post('/delete_department_head', 'DepartmentHeadController@deleteDepartmentHead');


    // Performance Review
    Route::post('/create_performance_review','PerformanceReviewController@createPerformanceReview');
    Route::get('/retrieve_performance_reviews','PerformanceReviewController@retrievePerformanceReviews');
    Route::get('/retrieve_performance_review/{id}','PerformanceReviewController@retrieveLimitedPerformanceReview');
    Route::get('/retrieve_performance_review_by_employee/{id}','PerformanceReviewController@retrieveLimitedPerformanceReviewByEmployee');
});


// this routes are needed with jwt token, you need first to login before executing this routes
// Route::group(['middleware' => ['jwt.auth', 'api-header']], function () {

//      // all routes to protected resources are registered here
//      Route::get('/retrieve_users', 'UserController@retrieveUsers');

// });

// User
// Route::post('/create_user', 'AccountController@createUser');
// Route::post('/retrieve_user', 'UserController@retrieveUser');
// Route::post('/update_user', 'UserController@updateUser');
// Route::post('/delete_user', 'UserController@deleteUser');

// Employee
Route::post('/retrieve_employee_limited', 'EmployeeController@retrieveEmployeeLimited');
Route::get('/getProfile', 'EmployeeController@retrieveEmployeeProfile');
// Route::post('/update_employee', 'EmployeeController@updateEmployee');
// Route::post('/delete_employee' , 'EmployeeController@deleteEmployee');

// // Employee Leave
Route::post('/create_request_leave', 'LeaveRequestController@createLeaveRequest');
Route::post('/getLeaveRequest', 'LeaveRequestController@getLeaveRequests');
// Route::post('/validateToken' ,)
// Route::post('/retrieve_remaining_leave', 'EmployeeLeaveController@retrieveRemainingLeave');
// Route::post('/retrieve_employees_on_leave', 'EmployeeLeaveController@retrieveEmployeesOnLeave');
// Route::post('/retrieve_employees_request_leave', 'EmployeeLeaveController@retrieveEmployeesRequestLeave');

// // Employee Duty
// Route::post('/retrieve_employees_on_duty', 'EmployeeDutyController@retrieveEmployeesOnDuty');

// // Organizational Chart
// Route::post('/retrieve_organizational_chart', 'OrganiztionController@retrieveOrganizationalChart');

// // Company Policy
// Route::post('/retrieve_company_policy', 'CompanyController@retrieveCompanyPolicy');
// Route::post('/create_company_policy', 'CompanyController@createCompanyPolicy');

// // Time Keeping
// Route::post('/create_time_in', 'TimeKeepingController@createTimeIn');
// Route::post('/create_time_out', 'TimeKeepingController@createTimeOut');
// Route::post('/retrieve_time_keep_summary', 'TimeKeepingController@retrieveTimeKeepSummary');

// // Employee Requisition
// Route::post('/create_requisition_form', 'EmployeeRequisitionController@createRequisitionForm');
// Route::post('/retrieve_requisition_forms', 'EmployeeRequisitionController@retrieveRequisitionForms');

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


