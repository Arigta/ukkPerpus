<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    public $baseURL = 'http://localhost:8080/';
    public $indexPage = '';
    public $uriProtocol = 'REQUEST_URI';
    public $urlSuffix = '';
    public $defaultLocale = 'en';
    public $negotiateLocale = false;
    public $supportedLocales = ['en'];

    // Session configuration
    public $sessionDriver = 'CodeIgniter\Session\Handlers\DatabaseHandler'; // atau sesuai dengan driver yang Anda gunakan
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = 'ci_sessions';
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;

    // Other configurations...
}
