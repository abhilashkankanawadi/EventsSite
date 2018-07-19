<?php// Route::get('/', function () {//     return view('welcome'); // });Route::get('/', 'EventsController@index');Route::group(['prefix' => 'organiser'], function() {  Route::get('/', 'Auth\OrganiserRegisterController@index');	Route::get('/dashboard', 'OrganiserDashboardController@show');  Route::post('/register', 'Auth\OrganiserRegisterController@create');  Route::get('/login', 'Auth\OrganiserLoginController@index');	Route::post('/logins', 'Auth\OrganiserLoginController@doLogin');}); // Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {//     // Route::get('/', 'AdminController@welcome');//      Route::post('/events', ['middleware' => ['permission:create'], 'uses' => 'EventsController@store']);//     Route::get('/events','EventsController@index');//     Route::get('/events/{id}','EventsController@show');//     //Route::post('/events','EventsController@store');//     Route::put('/events/{id}','EventsController@update');//     Route::delete('/events/{id}','EventsController@delete');//Route::post('/register','RegistrationController@register');Route::get('userEdit/{id}','UserProfileController@edit');Route::post('userUpdate/{id}','UserProfileController@update');Route::group(['prefix'=>'v1'], function(){  Route::get('/sms','ChatController@index');  Route::get('/sms/{id}','ChatController@show');  Route::post('/sms','ChatController@store');  Route::delete('/sms/{id}','ChatController@delete');  Route::get('/bulkmail','MailController@mailing');  Route::get('/bulkmsg','MessageController@msg');});Auth::routes();Route::get('/createEvent','EventsController@create');Route::get('/home', 'EventsController@index');Route::get('/home/{id}','EventsController@edit');Route::get('/remove/{id}','EventsController@delete');Route::post('/up/{id}','EventsController@update');Route::post('/store','EventsController@store');// below routes are related to bladeRoute::get('/activityfeed/{id}','EventsController@show');//AgencyRoute::post('/agencyUpdate/{id}','AgencyController@update');//organiserRoute::post('/organiserChange/{id}','UserProfileController@update');//eventsRoute::get('/upcoming','EventsController@eventUpcoming');Route::get('/pastevents','EventsController@eventUpcoming'); //agendaRoute::get('/agenda/{id}','EventDayInfoController@show');Route::post('/agenda','EventDayInfoController@myagends');// Route::get('/agendadetails/{id}','AgendaDetailsController@show');//activityfeedRoute::get('addpost/{id}','PostController@show');Route::post('/postcont/{id}','PostController@store');//exhibiors Route::post('/exhibitorUpdate/{id}','ExhibitorController@update');//partnersRoute::get('/partners/{id}','PartnersController@show');//partnerCategoryRoute::get('/partnerCategory/{id}','PartnershipCategoryController@show');//attendees// Route::get('/attendee/{id}','AttendeeController@show');Route::get('/attendee/{id}','AttendeeController@show');Route::get('/attendeeAdd/{id}',function(){  return view('attendee.AttendeeInsert');});Route::get('attendeeEdit/{id}','AttendeeController@edit');Route::post('attendeeChange/{id}','AttendeeController@update');Route::post('/attendeeInsert','AttendeeController@store');Route::get('/attendeeprofile/{id}','AttendeeProfileController@index');Route::post('/attendeeprofile/{id}','AttendeeMessageController@store');Route::post('/addNotification/{id}','AttendeeController@notificationStatus');Route::get('/attendNotification/{id}','AttendeeController@notification');Route::post('/deleteNotify/{id}','AttendeeController@deleteNotification');//attendeeFollowRoute::post('folls/{id}','AttendeeFollowController@store');Route::get('/unfolls/{id}','AttendeeFollowController@destroy');//SpeakerRoute::get('speaker/{id}','SpeakerController@show');Route::post('speakerUpdate/{id}','SpeakerController@Update');Route::get('speakerprofile/{id}','SpeakerProfileController@show');Route::post('speakermsg/{id}','SpeakerMsgController@store');////Route::get('organiser/{id}','OrganiserController@show');//promotionsRoute::get('promotion/{id}','PromotionController@show');Route::post('postPromotion/{id}','PromotionController@store');//conference detailsRoute::get('details/{id}','ConferenceDetailsController@show');//Discussion ChannelsRoute::get('discussion/{id}','DiscussionChannelController@show');Route::get('newdiscussion',function(){  return view('DiscussionChannel.NewChannel');});Route::post('addnew/{id}','DiscussionChannelController@store');Route::post('join/{id}','JoinChannelController@store');Route::get('chat/{id}','ChatController@show');Route::post('send/{id}','ChatController@store');//photo feedsRoute::get('photos/{id}','PhotoFeedController@show');Route::post('upload/{id}','PhotoFeedController@store');Route::get('photoDetail/{id}','PhotoFeedController@index');//Route::post('commentlike/{id}','PhotoCommentController@store');Route::post('like/{id}','PhotoLikeController@store');//meeting plannerRoute::get('meeting/{id}','MeetingPlannerController@show');Route::post('requestmeet/{id}','MeetingPlannerController@store');Route::get('deleteRequest/{id}','MeetingPlannerController@delete');// Route::get('attendeeRequest/{id}','MeetingPlannerController@attendeeDetails');// Route::get('partnerRequest/{id}','MeetingPlannerController@partnerDetails');// Route::get('speakerRequest/{id}','MeetingPlannerController@speakerDetails');Route::post('/sendReqToDeligate/{id}','MeetingPlannerController@OrgSendToDeligate');Route::get('deleteReq/{id}','MeetingPlannerController@delMeetReq');