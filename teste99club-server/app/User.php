<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use App\Notifications\AccountConfirm;

use App\Lib\Geocode;

use Auth;
use DateTime;
use DB;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable, SpatialTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
    'name', 'email', 'password', 'sex', 'interest', 'avatar', 'birth_date', 'about',
    'feed_max_distance'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
  ];

  protected $spatialFields = [
    'location'
  ];

  public function toAppJson()
  {
    $authUser = Auth::user();

		$jsonObj = [
			'id' => $this->id,
			'name' => $this->name,
			'age' => date_diff(date_create($this->birth_date), date_create('today'))->y,
			'sex' => $this->sex == 'm' ? 'male' : 'female',
			'avatar' => $this->avatar,
			'about' => $this->about,
		];

		if ($authUser->id == $this->id) {
			$additionalInfo = [
				'email' => $this->email,
				'interest' => $this->interest,
				'feedMaxDistance'=> $this->feed_max_distance
			];

			$jsonObj = array_merge($jsonObj, $additionalInfo);
		}

		return $jsonObj;

  }

	public function createApiToken()
	{
		$this->tokens()->delete();
		return $this->createToken('api_token')->accessToken;
	}


	public static function authenticate($email, $password)
	{
		if(Auth::attempt(['email' => $email, 'password' => $password])) {
			return Auth::user();
		} else {
			return false;
		}
  }

	public function accountConfirm()
	{
		$notification = $this->notify(new AccountConfirm);
		return $notification;
	}
	/**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
