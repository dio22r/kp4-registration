<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
	public $nama;
	public $username;
	public $password;
	public $role;

	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];

	public function setPassword()
	{
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
	}
}
