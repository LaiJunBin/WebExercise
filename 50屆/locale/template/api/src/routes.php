<?php
    Route::get('/test', function(Request $request){
        return Response()->api(true, '', 'the data from api.');
    });

    Route::post('/login', 'UserController@login');