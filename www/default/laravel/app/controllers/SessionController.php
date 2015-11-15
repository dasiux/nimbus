<?php

class SessionController extends BaseController {

    public function showLogin() {
        return View::make('sessions.login');
    }

    public function doLogout() {
        Auth::logout();
        return Redirect::to('login')
            ->with('message', 'logged out&hellip;');
    }

    public function doLogin() {
        // check for email
        $rules = array('email' => 'required|email|exists:users,email','password' => 'required|min:3');
        $validator = Validator::make(Input::all(), $rules);
        $isUsername = false;
        // check for username
        if ($validator->fails()) {
            $rules = array('email' => 'required|exists:users,name','password' => 'required|min:3');
            $validator = Validator::make(Input::all(), $rules);
            $isUsername = true;
        }
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->with('message',"invalid login&hellip;")
                ->withInput(Input::except('password'));
        } else {
            $email = Input::get('email');
            if ($isUsername) {
                $user = User::where('name','=',$email)->first();
                $email = $user->email;
            }
            // create our user data for the authentication
            $userdata = array(
                'email' 	=> $email,
                'password' 	=> Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                return Redirect::to('/')
                    ->with('message','logged in&hellip;');

            } else {
                // validation not successful, send back to form
                return Redirect::back()
                    ->withInput()
                    ->with('message',"invalid login&hellip;");
            }
        }
    }
}
