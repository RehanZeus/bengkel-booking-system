<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'name',
        'slug',
        'description',
        'duration_minutes',
        'price_estimate',
        'is_active',
    ];

    protected $useTimestamps = false;

    /**
     * Ambil seluruh layanan aktif.
     */
    public function active(): array
    {
        return $this->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
    }
}
