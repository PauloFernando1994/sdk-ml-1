<?php


namespace App\Api;


use App\Facades\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use GuzzleHttp\json_encode;


class Token implements Message
{

    private $app;
    private $failed;
    protected $token;

    /**
     * Token constructor.
     */
    public function __construct()
    {
        $this->app = (new Application());
    }

    /**
     * @return mixed
     */
    public function failed()
    {
        return $this->failed;
    }

    /**
     * @param $code
     * @param string $patch
     * @return TokenAccess
     */
    public function setToken($code, $patch = "/")
    {

        if (!is_string($code)) throw new Exception('Esperamos uma string em $code');

        $http = Http::withHeaders(['accept' => 'application/json', 'Content-Type' => "application/x-www-form-urlencoded"])
            ->post($this->app->getCore()->token(), [
                'grant_type' => 'authorization_code',
                'client_id' => $this->app->getId(),
                'client_secret' => $this->app->getClientSecret(),
                'redirect_uri' => $this->app->callbackUrl($patch),
                'code' => $code
            ]);


        if ($http->failed()) {

            $this->failed = $http->object();

            throw new Exception(self::FAIL_REQUISITION);
        }


        $token = $http->object();

        if (!Storage::put('/public/users/' . $token->user_id . '/token/access_token.json', json_encode($token, 128))) {
            throw new Exception("Token invalido");
        }

        return new TokenAccess($http->object());
    }


    /**
     * @param $code
     * @return TokenAccess
     */
    public function setRefreshToken($code)
    {
        $http = Http::withHeaders([
            'accept' => 'application/json',
            'Content-Type' => "application/x-www-form-urlencoded"
        ])->post($this->app->getCore()->token(), [
            'grant_type' => 'refresh_token',
            'client_id' => $this->app->getId(),
            'client_secret' => $this->app->getClientSecret(),
            'refresh_token' => $code
        ]);

        if ($http->failed()) {

            $this->failed = $http->object();

            throw new Exception(self::FAIL_REQUISITION);
        }

        $token = $http->object();

        if (!Storage::put('/public/users/' . $token->user_id . '/token/access_token.json', json_encode($token, 128))) {
            throw new Exception("Token invalido");
        }

        return new TokenAccess($http->object());

    }

    /**
     * @param int $user_id
     * @return TokenAccess
     */
    public function getToken(int $user_id)
    {
        if (!Storage::exists('/public/users/' . $user_id . '/token/access_token.json')) {
            throw new Exception("Access Token não encontrado");
        }

        return new TokenAccess(json_decode(Storage::get('/public/users/' . $user_id . '/token/access_token.json')));
    }
}
