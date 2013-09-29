<?php

// IMPORTANT FOR TESTING!!!
// Copy purchase.php from /Vendors/AnthonyVipond/StripeHelper/SRC/Controllers and paste in your app's controllers folder
// Copy purchase.blade.php from /Vendors/AnthonyVipond/StripeHelper/SRC/Views and paste in your app's views folder
// Use the invocation below into your app/routes.php

Route::get('/', 'PurchaseController@purchase');
Route::post('process', 'PurchaseController@process');