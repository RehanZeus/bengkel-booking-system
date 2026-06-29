<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * Controller induk untuk seluruh controller aplikasi.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance request.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helper yang dimuat otomatis untuk seluruh controller.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'text'];

    /**
     * Properti session bersama.
     */
    protected $session;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = service('session');
    }
}
