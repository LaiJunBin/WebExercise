<?php

    class UserController{

        public function __construct(){

        }

        public function login(Request $request){
            $validation = Validate::require($request->json(), ['username', 'password']);
            if($validation->fails())
                return Response()->error(401);
            
            $input = $validation->data();

            $user = Database::use('users')->find($input)->get();
            if($user == null){
                return Response()->api(false, 'user not found.', '');
            }

            return Response()->api(true, '', $user);
        }
    }