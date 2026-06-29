<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = ['username', 'password', 'full_name'];

    protected $useTimestamps = false;

    /**
     * Verifikasi kredensial admin.
     * Mengembalikan data admin (tanpa password) jika valid, atau null.
     */
    public function verify(string $username, string $password): ?array
    {
        $admin = $this->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            unset($admin['password']);

            return $admin;
        }

        return null;
    }
}
