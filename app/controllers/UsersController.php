<?php

class UsersController extends \BaseController {
      protected $user;


      public function __construct(User $user) {
      	     $this->user = $user;

      }

      public function index () {
      	     $users = $this->user->all();
     	     return View::make('users/index')->withUsers($users);
      }     


      public function show ($username) {
          
      }

      public function create () {
      	     return View::make('users.create');
      }


      public function store () {
          
	     $input = Input::all();
      	 if (!$this->user->fill($input)->isValid()) {
             
                $response = array(
                    'status' => 1,
                    'errors' => $this->user->messages
                );
    	     	return Response::json($response);      
	     }


	     $this->user->save();
          
          $response = array(
              'status' => 0
          );
	     return Response::json($response);
      }


      public function edit ($username) {

	if(!Auth::check() || Auth::user()->username != $username)
		return Redirect::route('home');

	$user = $this->user->whereUsername($username)->first();
	return View::make('users/edit', ['user' => $user]);

      }



	public function update () {

		$user = Auth::user();

		$newpass = Input::get('newPassword');
		$confirmpass = Input::get('confirmPassword');
		$moduname = Input::get('namechange');

		if($newpass != '')
		{
			if($newpass != $confirmpass)
			{

				return Redirect::back()->withErrors(['password'=>'Mismatched Passwords']);

			}

			echo $user;

			$user->password = $newpass;

		}

		if($moduname == '')
		{
			$moduname = (Auth::user()->username);
		}

		$user->username = $moduname;

		if(!$user->isUpdateValid())
		{

			return Redirect::back()->withErrors($user->messages);

		}

		$user->save();

		return Redirect::route('users.edit', $user->username);

	}

	public function destroy () {
		
		$user = User::find(Auth::user()->id);
		Auth::logout();
		if($user->delete()) return Redirect::route('home');		

	}

      
}
