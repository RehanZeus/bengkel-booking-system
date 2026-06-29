<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = ['name', 'phone', 'email'];

    protected $useTimestamps = false;

    /**
     * Cari pelanggan berdasarkan nomor HP, atau buat baru jika belum ada.
     * Mencegah duplikasi data pelanggan.
     */
    public function findOrCreate(array $data): int
    {
        $existing = $this->where('phone', $data['phone'])->first();

        if ($existing) {
            // Perbarui nama/email bila berubah.
            $this->update($existing['id'], [
                'name'  => $data['name'],
                'email' => $data['email'] ?? $existing['email'],
            ]);

            return (int) $existing['id'];
        }

        return (int) $this->insert($data, true);
    }
}
