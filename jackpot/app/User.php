<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'uid', 'group_id', 'token', 'user_info'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token', 'deleted_at', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function addUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = new User($data);
        $user->save();
        return $user;
    }

    public function updateUser($id, $data)
    {
        $instance = $this->findOrFail($id);
        if (isset($data['password']) && isset($data['password_confirmation'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        $instance->update($data);
        return $instance->toArray();
    }

    public function deleteUser($id)
    {
        $instance = $this->findOrFail($id);
        return $instance->delete();
    }

    public function deleteUsers($ids)
    {
        $instance = $this->whereIn('id', $ids);
        return $instance->delete();
    }

    public function updateToken($id, $token)
    {
        return $this->findOrFail($id)->update([
            'token' => $token
        ]);
    }

    public function user_setting()
    {
        return $this->hasMany(UserSetting::class, 'uid');
    }

    public function credit_activities()
    {
        return $this->hasMany(CreditActivity::class, 'uid');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'uid');
    }

    public function user_commissions()
    {
        return $this->hasMany(Commission::class, 'uid');
    }

    public function from_commissions()
    {
        return $this->hasMany(Commission::class, 'from_id');
    }

    public function credits()
    {
        return $this->hasMany(Credit::class, 'uid');
    }

    public function isSuperAdmin()
    {
        return $this->group->type === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->group->type === 'admin';
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'uid');
    }

}
