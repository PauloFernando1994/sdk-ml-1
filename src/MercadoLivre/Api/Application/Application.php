<?php


namespace App\Api;

use App\Facades\Uri;
use App\Facades\UrlSite;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class Application implements UrlSite
{

    private $app;
    private $failed;
    private $clientSecret;


    /**
     * Application constructor.
     */
    public function __construct()
    {
        if (!is_string(env('APP_ID'))) throw new Exception('Esperando um INT em $appId');
        if (!is_string(env('CLIENT_ID'))) throw new Exception('Esperando uma string em $clientSecret');

        $http = Http::get(self::CORE[env('LANG')] . self::APP . env('APP_ID'));

        if ($http->failed()) {
            $this->failed = $http->object();
            throw new Exception($http->body());
        }

        $this->app = $http->object();
        $this->clientSecret = env('CLIENT_ID');

    }


    /**
     * @return mixed Retorna a ID do aplicativo
     */
    public function getId()
    {
        if ($this->failed()) {
            throw new Exception("Aplicativo não encontrado");
        }

        if (!isset($this->app->id)) throw new Exception('ID Invalida');

        return $this->app->id;
    }


    /**
     * @return mixed Retorna o nome aplicativo
     */
    public function getName()
    {
        return $this->app->name;
    }

    /**
     * @return mixed Retorna a descrição do app aplicativo
     */
    public function getDescription()
    {
        return $this->app->description;
    }

    /**
     * @return mixed Retorna a logo aplicativo
     */
    public function getThumbnail()
    {
        return $this->app->thumbnail;
    }

    /**
     * @return mixed
     */
    public function getCatalogProductId()
    {
        return $this->app->catalog_product_id;
    }

    /**
     * @return mixed Retorna item_id do aplicativo
     */
    public function getItemId()
    {
        return $this->app->item_id;
    }

    /**
     * @return mixed Retorna o preço cadastrado no App
     */
    public function getPrice()
    {
        return $this->app->price;
    }

    /**+
     * @return mixed Retorna a moeda do app
     */
    public function getCurrentId()
    {
        return $this->app->currency_id;
    }

    /**
     * @return mixed Retorna o short_name do aplicativo
     */
    public function getShortName()
    {
        return $this->app->short_name;
    }

    /**
     * @return mixed Retorna se o app é apenas teste
     */
    public function getSandboxMode()
    {
        return $this->app->sandbox_mode;
    }

    /**
     * @return mixed Retorna ID do projeto
     */
    public function getProjectId()
    {
        return $this->app->project_id;
    }

    /**
     * @return mixed Retorna o status do app
     */
    public function getActive()
    {
        return $this->app->active;
    }

    /**
     * @return mixed Retorna a quantidade de requisição feitas por horas
     */
    public function getMaxRequestsPerHour()
    {
        return $this->app->max_requests_per_hour;
    }

    /**
     * @return mixed Retorna o Scope do aplicativo
     */
    public function getScopes()
    {
        return $this->app->scopes;
    }

    /**
     * @return mixed Retorna os dominios autorizados
     */
    public function getDomains()
    {
        return $this->app->domains;
    }

    /**
     * @return mixed Retorna o certificado do app
     */
    public function getCertificationStatus()
    {
        return $this->app->certification_status;
    }

    /**
     * @param null $patch
     * @return string Retorna a URL de retorno
     */
    public function callbackUrl($patch = null)
    {


        if (!isset($this->app->callback_url)) throw new Exception('Url Invalida');

        $url = parse_url($this->app->callback_url);

        if ($url['host'] === 'localhost') {
            $this->app->callback_url = $this->app->callback_url;
        }

        return $this->app->callback_url . $patch;
    }


    /**
     * @return mixed Retorna a url da aplicação
     */
    public function getUrl()
    {
        if (!isset($this->app->url)) throw new Exception('Url Invalida');

        return $this->app->url;
    }

    /**
     * @return Uri
     */
    public function getCore()
    {
        return new Uri([
            'core' => self::CORE[env('LANG', 'br')],
            'auth' => self::AUTH
        ], $this->app);
    }


    /**
     * @return mixed Retorna o Cliente secredo do ML
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return mixed retorna todos os dados
     */
    public function all()
    {
        return $this->app;
    }

    /**
     * @return object Verifica se existe á um error
     */
    public function failed()
    {
        return $this->failed;
    }

}
