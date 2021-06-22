<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailVerifyMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;

class UserController extends HomeController
{
    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin/admin-users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $user = User::where('email', $email)->first();
            if($user) {
                if($user->email_verified_at != null){
                    if(password_verify($password, $user->password)){
                        session()->put('user', $user);
                        self::log('Login', 'A user has logged in. E-mail: ' . $email);
                        return redirect()->route('home');
                    }else {
                        dd("Wrong password");
                        self::log('Login failure', 'Wrong password submited');
                    }
                }else {
                    dd("E-mail not verified");
                    self::log('Login failure', 'E-mail not verified');
                }
            }else {
                dd("E-mail not found");
                self::log('Login failure', 'E-mail not found');
            }
        }catch (\Exception $exception) {
            self::log('Exception', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirmation');

        $code = $this->generateRandomString(10);
        $avatar = 'assets/images/avatars/' . strval(rand(1, 37)) . '.png';

        $model = new User();
        $user = $model->register($email, $username, $password, $code, $avatar);
        if($user){
            $url = 'http://localhost:8000/email_verify/' . $email . '/' . $code;
            Mail::to($email)->send(new EmailVerifyMail(['url' => $url]));

            //session()->put('user', $user);
            //self::log('registration');
            //self::log('initial log in');
            return view('sign-up-success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('password');
        $user =  User::find(intval($id));
        if(password_verify($old_password, $user->password)){
            $user->password = password_hash($new_password, PASSWORD_DEFAULT);
            $user->save();
            return redirect()->route('profile');
        }else {
            return view('profile', ['error' => 'Wrong password']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function logout(){
        session()->flush();
        #Logger::log("A user logged out");
        return redirect()->route('home');
    }

    public function password_reset(Request $request){
        $response = [];
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $new_password = $this->generateRandomString(10);
        $model = new User();
        if($user){
            if($user->email_verified_at != null){
                if($model->update_password($email, $new_password)){
                    Mail::to($email)->send(new PasswordReset(['new_password' => $new_password]));
                    $response['result'] = 'Check your email';
                }else {
                    $response['error'] = 'Something went wrong';
                }
            }else {
                $response['error'] = 'E-mail not verified';
            }
        }else {
            $response['error'] = 'E-mail not found';
        }

        return view('password-reset', ['response' => $response]);
    }

    public function email_verify($email, $code){
        $model = new User();
        $model->email_verify($email, $code);
        if($model){
            return redirect()->route('login');
        }else {
            return redirect()->route('register');
        }
    }
}
