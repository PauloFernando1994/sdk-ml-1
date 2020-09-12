<?php


namespace App\Api;


use App\Facades\UrlSite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class Auth implements UrlSite
{

    private $appId;
    private $clientSecret;
    private $site_id;
    private $app;

    public function __construct()
    {

        if (!env('APP_ID')) throw new Exception('Defina o App ID no seu arquivo .env');
        if (!env('CLIENT_ID')) throw new Exception('Defina o App CLIENT_ID no seu arquivo .env');

        $this->site_id = self::CORE[env('LANG', 'br')];
        $this->appId = env('APP_ID');
        $this->clientSecret = env('CLIENT_ID');

        $this->app = (new Application());

    }

    public function redirect($patch, $redirect = true)
    {
        return $this->app->getCore()->auth($patch, $redirect);
    }

    public function getApp()
    {
        return $this->app;
    }

    public function token()
    {
        return new Token();
    }
}
