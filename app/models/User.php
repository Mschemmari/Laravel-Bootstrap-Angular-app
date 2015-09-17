<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface{

	protected $table = 'users';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('username', 'password', 'email', 'active');
	protected $visible = array('username', 'email', 'active');
	protected $hidden = array('password');

	protected $rules = array(
        'username'   => 'required|min:2',
        'email'   => 'required|min:2'
    );
	/**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken() {}
    public function setRememberToken($token) {}
    public function getRememberTokenName() {}

    public function scopeByActive($query)
    {
        return $query->where('active', '=', 'Y');
    }

}