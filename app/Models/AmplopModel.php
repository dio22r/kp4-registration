<?php

namespace App\Models;

use CodeIgniter\Model;

class AmplopModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'amplop';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"nama", "keterangan", "amplop_key", "status_kembali", "status",
		"jumlah", "ket_kembali", "tgl_kembali"
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		"nama" => "required",
		"amplop_key" => "required"
	];
	protected $validationMessages   = [
		"nama" => "Nama harus diisi",
		"amplop_key" => "Harus ada QRCode"
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
}
