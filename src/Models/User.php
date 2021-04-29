<?php

namespace App\Models\Users;

class User extends \Illuminate\Database\Eloquent\Model {
	protected $fillable = ['name', 'email', 'password', 'qr_code_url', 'stripe_account_id'];
	protected $table = 'users';
}