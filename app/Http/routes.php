<?php
Route::group(array('prefix' => 'api/v1/examples','middleware' => 'auth.basic.once'), function () {
	Route::get('1', 'ExamplesController@example1');
	Route::get('2', 'ExamplesController@example2');
	Route::get('3', 'ExamplesController@example3');
	Route::get('4', 'ExamplesController@example4');
	Route::get('5', 'ExamplesController@example5');
	Route::get('6', 'ExamplesController@example6');
	Route::get('latest_users', 'ExamplesController@example7');
	Route::get('youngest_user', 'ExamplesController@example8');
	Route::get('9', 'ExamplesController@example9');
});
