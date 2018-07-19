<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function(){

  Route::get('/agency','AgencyController@index');
  Route::get('/agency/{id}','AgencyController@show');
  Route::post('/agency','AgencyController@store');
  Route::put('/agency/{id}','AgencyController@update');
  Route::delete('/agency/{id}','AgencyController@delete');

  Route::post('/events','EventsController@store');
  Route::get('/events','EventsController@index');
  Route::get('/events/{id}','EventsController@show');
  Route::put('/events/{id}','EventsController@update');
  Route::delete('/events/{id}','EventsController@delete');

  Route::post('/eventsday','EventDayInfoController@store');
  Route::get('/eventsday','EventDayInfoController@index');
  Route::get('/eventsday/{id}','EventDayInfoController@show');
  Route::put('/eventsday/{id}','EventDayInfoController@update');
  Route::delete('/eventsday/{id}','EventDayInfoController@delete');

  Route::post('/eventReview','Event_reviewController@store');
  Route::get('/eventReview','Event_reviewController@index');
  Route::get('/eventReview/{id}','Event_reviewController@show');
  Route::put('/eventReview/{id}','Event_reviewController@update');
  Route::delete('/eventReview/{id}','Event_reviewController@delete');

  Route::get('/attendee','AttendeeController@index');
  Route::get('/attendee/{id}','AttendeeController@show');
  Route::post('/attendee','AttendeeController@store');
  Route::put('/attendee/{id}','AttendeeController@update');
  Route::delete('/attendee/{id}','AttendeeController@delete');

  Route::get('/attendeenotes','AttendeeNotesController@index');
  Route::get('/attendeenotes/{id}','AttendeeNotesController@show');
  Route::post('/attendeenotes','AttendeeNotesController@store');
  Route::put('/attendeenotes/{id}','AttendeeNotesController@update');
  Route::delete('/attendeenotes/{id}','AttendeeNotesController@delete');

  Route::get('/attendeeactivity','AttendeeActivityController@index');
  Route::get('/attendeeactivity/{id}','AttendeeActivityController@show');
  Route::post('/attendeeactivity','AttendeeActivityController@store');
  Route::put('/attendeeactivity/{id}','AttendeeActivityController@update');
  Route::delete('/attendeeactivity/{id}','AttendeeActivityController@delete');

  Route::get('/speaker','SpeakerController@index');
  Route::get('/speaker/{id}','SpeakerController@show');
  Route::post('/speaker','SpeakerController@store');
  Route::put('/speaker/{id}','SpeakerController@update');
  Route::delete('/speaker/{id}','SpeakerController@delete');

  Route::get('/speakernotes','SpeakerNotesController@index');
  Route::get('/speakernotes/{id}','SpeakerNotesController@show');
  Route::post('/speakernotes','SpeakerNotesController@store');
  Route::put('/speakernotes/{id}','SpeakerNotesController@update');
  Route::delete('/speakernotes/{id}','SpeakerNotesController@delete');

  Route::get('/speakersession','SpeakerSessionsController@index');
  Route::get('/speakersession/{id}','SpeakerSessionsController@show');
  Route::post('/speakersession','SpeakerSessionsController@store');
  Route::put('/speakersession/{id}','SpeakerSessionsController@update');
  Route::delete('/speakersession/{id}','SpeakerSessionsController@delete');

  // Route::get('/speakerevents','SpeakerEventsController@index');
  // Route::get('/speakerevents/{id}','SpeakerEventsController@show');
  // Route::post('/speakerevents','SpeakerEventsController@store');
  // Route::put('/speakerevents/{id}','SpeakerEventsController@update');
  // Route::delete('/speakerevents/{id}','SpeakerEventsController@delete');

  Route::get('/sms','ChatController@index');
  Route::get('/sms/{id}','ChatController@show');
  Route::post('/sms','ChatController@store');
  Route::delete('/sms/{id}','ChatController@delete');

  Route::get('/organiser','OrganiserController@index');
  Route::get('/organiser/{id}','OrganiserController@show');
  Route::post('/organiser','OrganiserController@store');
  Route::put('/organiser/{id}','OrganiserController@update');
  Route::delete('/organiser/{id}','OrganiserController@delete');

  Route::get('/exhibitor','ExhibitorController@index');
  Route::get('/exhibitor/{id}','ExhibitorController@show');
  Route::post('/exhibitor','ExhibitorController@store');
  Route::put('/exhibitor/{id}','ExhibitorController@update');
  Route::delete('/exhibitor/{id}','ExhibitorController@delete');

  Route::get('/venue','VenueController@index');
  Route::get('/venue/{id}','VenueController@show');
  Route::post('/venue','VenueController@store');
  Route::put('/venue/{id}','VenueController@update');
  Route::delete('/venue/{id}','VenueController@delete');

  Route::post('/venueReview','Venue_reviewController@store');
  Route::get('/venueReview','Venue_reviewController@index');
  Route::get('/venueReview/{id}','Venue_reviewController@show');
  Route::put('/venueReview/{id}','Venue_reviewController@update');
  Route::delete('/venueReview/{id}','Venue_reviewController@delete');

  Route::get('/venueFinancialDetails','VenueFinancialDetailsController@index');
  Route::get('/venueFinancialDetails/{id}','VenueFinancialDetailsController@show');
  Route::post('/venueFinancialDetails','VenueFinancialDetailsController@store');
  Route::put('/venueFinancialDetails/{id}','VenueFinancialDetailsController@update');
  Route::delete('/venueFinancialDetails/{id}','VenueFinancialDetailsController@delete');

  Route::get('/content','ContentController@index');
  Route::get('/content/{id}','ContentController@show');
  Route::post('/content','ContentController@store');
  Route::put('/content/{id}','ContentController@update');
  Route::delete('/content/{id}','ContentController@delete');

  Route::get('/partners','PartnersController@index');
  Route::get('/partners/{id}','PartnersController@show');
  Route::post('/partners','PartnersController@store');
  Route::put('/partners/{id}','PartnersController@update');
  Route::delete('/partners/{id}','PartnersController@delete');

  Route::get('/exhibitions','ExhibitionsController@index');
  Route::get('/exhibitions/{id}','ExhibitionsController@show');
  Route::post('/exhibitions','ExhibitionsController@store');
  Route::put('/exhibitions/{id}','ExhibitionsController@update');
  Route::delete('/exhibitions/{id}','ExhibitionsController@delete');

  Route::get('/feeds','FeedsController@index');
  Route::get('/feeds/{id}','FeedsController@show');
  Route::post('/feeds','FeedsController@store');
  Route::put('/feeds/{id}','FeedsController@update');
  Route::delete('/feeds/{id}','FeedsController@delete');

  Route::get('/posts','PostController@index');
  Route::get('/posts/{id}','PostController@show');
  Route::post('/posts','PostController@store');
  Route::put('/posts/{id}','PostController@update');
  Route::delete('/posts/{id}','PostController@delete');
});


Route::get('/invitee','InviteeController@index');
Route::get('/invitee/{id}','InviteeController@show');
Route::post('/invitee','InviteeController@store');
Route::put('/invitee/{id}','InviteeController@update');
Route::delete('/invitee/{id}','InviteeController@delete');

Route::get('/eventmanager','EventManagerController@index');
Route::get('/eventmanager/{id}','EventManagerController@show');
Route::post('/eventmanager','EventManagerController@store');
Route::put('/eventmanager/{id}','EventManagerController@update');
Route::delete('/eventmanager/{id}','EventManagerController@delete');

Route::get('/reviews','ReviewController@index');
Route::get('/reviews/{id}','ReviewController@show');
Route::post('/reviews','ReviewController@store');
Route::put('/reviews/{id}','ReviewController@update');
Route::delete('/reviews/{id}','ReviewController@delete');




Route::post('/register','RegistrationController@register');
Route::post('/role','EntrustController@store');
