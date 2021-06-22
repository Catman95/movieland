<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function insert($username, $email, $password) {
        \DB::table('users')
            ->insert([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
    }

    public function get_all() {
        return \DB::table('users')
            ->get();
    }

    public function single($id) {
        return \DB::table('users')
            ->where('id', $id)->first();
    }

    public function register($email, $username, $password, $code, $avatar) {
        \DB::table('users')
            ->insert([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'avatar' => $avatar
            ]);
        \DB::table('email_verification_codes')
            ->insert([
                'email' => $email,
                'code' => $code
            ]);
        return \DB::table('users')
            ->where('email', $email)->first();
    }

    public function get($current_page) {
        $per_page = 5;

        $count = \DB::table('users')->count();
        $pages_needed = ceil($count / $per_page);

        $users = \DB::table('users')
            //->orderBy('username', 'desc')
            ->offset((intval($current_page) - 1) * $per_page)
            ->limit($per_page)
            ->get();

        return ['users' => $users, 'pages_needed' => $pages_needed];
    }

    public function update_password($email, $new_password){
        return \DB::table('users')
            ->where('email', $email)
            ->update(['password' => password_hash($new_password, PASSWORD_DEFAULT)]);
    }

    /*public function delete($id) {
        \DB::table('users')
            ->where('id', $id)
            ->delete();
    }*/

    public function email_verify($email, $code){
        $row = \DB::table('email_verification_codes')
            ->where('email', $email)
            ->where('code', $code)
            ->first();
        if($row) {
            \DB::table('users')
                ->where('email', $email)
                ->update([
                    'email_verified_at' => date("Y-m-d H:i:s")
                ]);
            return $row;
        }
    }

}
