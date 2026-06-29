<?php

namespace App\Controllers;

use App\Models\ServiceModel;

class Home extends BaseController
{
    /**
     * Landing page profil bengkel.
     */
    public function index()
    {
        $serviceModel = new ServiceModel();

        $data = [
            'title'    => 'Bengkel PrimaMotor - Solusi Perawatan Mobil Presisi',
            'services' => $serviceModel->active(),
        ];

        return view('home/index', $data);
    }
}
