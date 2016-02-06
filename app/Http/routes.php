<?php

Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@home');
Route::get('login', 'PagesController@login');
Route::get('about', 'PagesController@about');

Route::get('login/termcondition', 'PagesController@termcondition');
Route::get('login/privacyprolicy', 'PagesController@privacy_policy');
Route::post('welcome/post', 'WelcomeController@welcomeSearch');

Route::controllers([
	'auth'		=>	'Auth\AuthController',
	'password'	=>	'Auth\PasswordController',
]);

Route::post('individual/store', 'UserController@store');
Route::post('corporate/store', 'CorporateController@store');

Route::get('verify', 'PagesController@verifyPage');
Route::get('verify/{id}', 'PagesController@verifyEmail');
Route::post('verify', 'PagesController@verifyMobile');

// Social login
Route::get('facebook', 'UserController@redirectToFacebook');
Route::get('user/fb', 'UserController@handleFacebookCallback');

Route::get('google', 'UserController@redirectToGoogle');
Route::get('user/gp', 'UserController@handleGoogleCallback');

Route::get('linkedin', 'UserController@redirectToLinkedin');
Route::get('user/li', 'UserController@handleLinkedinCallback');

Route::post('forget', 'UserController@forgetPassword');
Route::get('reset/password/{token}', 'UserController@resetPassword');
Route::post('reset/password', 'UserController@postResetPassword');

Route::group(array('middleware' => 'auth'), function(){

	Route::post('home', 'PagesController@homeFilter');
	Route::post('search/profile', 'PagesController@searchProfile');
	Route::post('home/skill', 'PagesController@homeskillFilter');

	Route::get('master', 'PagesController@master');
	Route::get('mypost', 'PagesController@myPost');
	Route::post('myactivity/post', 'PagesController@post');
	Route::post('/matching_criteria', 'PagesController@matching');
	Route::post('viewcontact/view', 'PagesController@viewContact');
	Route::post('postdetail/detail', 'PagesController@postDetail');

	Route::get('individual', 'UserController@index');
	Route::get('individual/create', 'UserController@create');
	Route::get('individual/edit', 'UserController@edit');
	Route::post('individual/update/{id}', 'UserController@update');
	Route::post('individual/basicupdate', 'UserController@basicUpdate');
	Route::post('individual/privacyUpdate/{id}', 'UserController@privacyUpdate');
	Route::post('individual/preferenceUpdate/{id}', 'UserController@preferenceUpdate');

	Route::get('corporate', 'CorporateController@index');
	Route::get('corporate/create', 'CorporateController@create');
	Route::post('corporate/update/{id}', 'CorporateController@update');
	Route::post('corporate/basicupdate', 'CorporateController@basicUpdate');
	Route::get('corporate/corporateView', 'CorporateController@corpView');
	Route::post('corporate/privacyUpdate/{id}', 'CorporateController@privacyUpdate');

	Route::get('searchProfile', 'PagesController@corpsearchProfile');
	Route::post('profile/fav', 'PagesController@favProfile');
	Route::get('favouriteProfile', 'PagesController@listFavourite');
	Route::post('profile/save', 'PagesController@saveProfile');

	Route::get('job/skillSearch', 'JobController@skillSearch');
	Route::get('job', 'JobController@index');
	Route::get('job/create', 'JobController@create');
	Route::post('job/store', 'JobController@store');
	Route::post('job/update', 'JobController@update');
	Route::post('job/like', 'JobController@postLike');
	Route::post('job/fav', 'JobController@postFav');
	Route::post('job/apply', 'JobController@postApply');
	Route::post('job/contact', 'JobController@postContact');
	Route::post('job/extend', 'JobController@postExtend');
	Route::post('job/extended', 'JobController@postExtended');
	Route::post('job/expire', 'JobController@postExpire');
	Route::post('job/newskill', 'JobController@addNewSkills');

	Route::get('skill', 'SkillController@index');
	Route::get('skill/create', 'SkillController@create');
	Route::post('skill/store', 'SkillController@store');
	Route::post('skill/update', 'SkillController@update');

	Route::get('followers', 'ConnectionsController@followers');
	Route::get('links', 'ConnectionsController@create');
	Route::get('connections', 'ConnectionsController@index');
	Route::get('connections/create', 'ConnectionsController@create');
	Route::post('connections/store', 'ConnectionsController@store');
	Route::post('connections/update', 'ConnectionsController@update');
	Route::post('connections/inviteFriend/{id}', 'ConnectionsController@inviteFriend');
	Route::post('connections/destroy/{id}', 'ConnectionsController@destroy');
	Route::post('connections/response/{id}', 'ConnectionsController@response');
	Route::post('connections/newLink/{id}', 'ConnectionsController@newLink');
	Route::post('connections/removeLink/{id}', 'ConnectionsController@removeLink');
	Route::get('connections/friendlink/{utype}/{id}', 'ConnectionsController@friendLink');
	Route::post('links/corporate/follow/{id}', 'ConnectionsController@linkPageFollow');
	Route::post('links/corporate/unfollow/{id}', 'ConnectionsController@linkPageUnfollow');
	
	Route::get('group', 'GroupController@index');
	Route::get('group/create', 'GroupController@create');
	Route::post('group/store', 'GroupController@store');
	Route::post('group/update/{id}', 'GroupController@update');
	Route::post('group/destroy/{id}', 'GroupController@destroy');
	Route::get('group/{id}', 'GroupController@detail');
	Route::post('group/adduser', 'GroupController@addUser');	
	Route::post('group/deleteuser', 'GroupController@deleteUser');
	Route::post('group/leavegroup', 'GroupController@leavegroup');

	Route::post('user/imgUpload', 'UserController@imgUpload');	
	Route::post('corporate/imgUpload', 'CorporateController@imgUpload');	

	Route::get('feedback', 'FeedbackController@index');
	Route::get('feedback/create', 'FeedbackController@create');
	Route::post('feedback/store', 'FeedbackController@store');
	Route::post('feedback/update', 'FeedbackController@update');
	Route::post('feedback/home', 'FeedbackController@report');

	Route::post('searchConnections', 'ConnectionsController@searchConnections');
	Route::post('searchLinks', 'GroupController@searchLinks');

	Route::get('individual_view', 'ViewpageController@index');
	Route::get('individual_view/create', 'ViewpageController@create');
	Route::get('individual/edit', 'ViewpageController@edit_view');
	Route::get('corporate/edit', 'ViewpageController@edit_view');
	// Route::get('profile/{utype}/{id}', 'ViewpageController@corpindView');
	// Route::get('individual/{id}/thanks', 'ViewpageController@thanks_view');	
	// Route::get('individual/posts_view', 'ViewpageController@posts_view');	

	Route::get('notify/{type}/{utype}/{id}', 'PagesController@notification');
	// Route::get('notification/notification', 'PagesController@notification');
	// Route::get('notification/notificationThanks', 'PagesController@notificationThanks');
	Route::get('profile/{name}/{utype}/{id}', 'PagesController@profile');

	// corporate follow/unfollow
	Route::post('follow-modal', 'PagesController@followModal');
	Route::post('corporate/follow/{id}', 'PagesController@follow');
	Route::post('corporate/unfollow/{id}', 'PagesController@unfollow');
	
	Route::post('me-change', 'UserController@edit_me');
	Route::post('me-change', 'UserController@edit_me');
	Route::post('send-otp', 'UserController@sendOTP');
	Route::post('verify-otp', 'UserController@verifyOTP');
	Route::post('send-evc', 'UserController@sendEVC');
	Route::post('verify-evc', 'UserController@verifyEVC');

	Route::get('favourite', 'PagesController@favourite');
	Route::get('postbyuser/{utype}/{id}', 'PagesController@postByUser');
	Route::get('postingroup/{id}', 'PagesController@postInGroup');
	Route::get('postid/{id}', 'PagesController@postId');


	Route::post('change/password', 'UserController@postChangePassword');
	Route::post('report-abuse', 'JobController@reportAbuse');
	Route::get('report-abuse', 'JobController@reportAbusePage');

	Route::post('post/share', 'JobController@sharePost');
	Route::post('/resendOTP', 'PagesController@resendOTP');

	Route::post('/notification/mark-as-read/{id}', 'NotificationController@update');
	Route::get('post/expire', 'JobController@expiringToday');
	Route::post('jobcategory/roles', 'JobRoleController@roleByCategories');
	Route::get('post/jobroles', 'JobController@jobRoles');

	Route::get('search/', 'PagesController@search');

	Route::get('home/{post_type}/{sort_by}', 'PagesController@homeSorting');
	Route::get('home/type/{post_type}/{sort_by_skill}', 'PagesController@homeskillSorting');


	// Admin Controller panel
	Route::post('admin/role/upload', 'AdminController@updateRole');
	Route::post('admin/industry/upload', 'AdminController@updateIndustry');
	Route::post('admin/functionalArea/upload', 'AdminController@updatefunctionalArea');
	Route::post('admin/industryfunctionalArea/upload', 'AdminController@updateIndustryfunctional');
	Route::post('admin/indfunctionalRole/upload', 'AdminController@updateIndfunctionalRole');

	Route::get('dataUpdate', 'AdminController@create');

	Route::post('roles/addroles', 'AdminController@addNewRoles');
	Route::get('roles/rolesSearch', 'AdminController@roleSearch');
	Route::post('roles/newrole', 'JobController@addNewRoles');

	Route::post('admin/deleterole', 'AdminController@deleteRole');
	Route::post('admin/deletefarea', 'AdminController@deletefunctionalArea');
	Route::post('admin/deleteindustry', 'AdminController@deleteIndustry');
	Route::post('admin/deleteifarea', 'AdminController@deleteindustryfareaMapping');

	Route::post('admin/updaterole/{id}', 'AdminController@editRole');
	Route::post('admin/updatefarea/{id}', 'AdminController@editFarea');
	Route::post('admin/updateindustry/{id}', 'AdminController@editIndustry');

	// report abuse
	Route::get('report-abuse/action/hidepost/{post_id}', 'JobController@hidePostForAbuse');
	Route::get('report-abuse/action/showpost/{post_id}', 'JobController@showPostAfterAbuse');
	Route::get('report-abuse/action/blockuser/{post_id}', 'JobController@blockUserForAbuse');
	Route::get('report-abuse/action/unblockuser/{post_id}', 'JobController@unblockUserAfterAbuse');
	Route::get('report-abuse/action/warningemail/{post_id}', 'JobController@warningEmailForAbuse');

});


