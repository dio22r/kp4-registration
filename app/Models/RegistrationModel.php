<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'register';
	protected $primaryKey           = 'id';
	// protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama', 'alamat', 'kontak', 'total_tagihan', 'keterangan', 'status_lunas', 'key', 'qrcode'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'nama' => 'required|min_length[3]',
		'alamat' => 'required',
		'kontak' => 'required',
	];
	protected $validationMessages   = [
		'nama' => [
			'required' => 'Nama harus diisi',
			'min_length' => 'Minimal 3 karakter',
		],
		'alamat' => [
			'required' => 'Alamat harus diisi'
		],
		'kontak' => [
			'required' => 'Kontak harus di isi dengan no telp., WA atau email'
		]
	];

	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function setAllowedFields(array $allowedFields = [])
	{
		$this->allowedFields = $allowedFields;
	}
}
