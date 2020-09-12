<?php


namespace App\Api;

/**
 * @method Site
 */

use App\Api\Auth\User;
use App\Site;
use Illuminate\Http\Client\Factory;


class TokenAccess
{

    private $token;

    /**
     * TokenAccess constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }


    /**
     * @return mixed
     */

    public function all()
    {

        if (!$this->token) return $this->failed();

        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        if (!$this->token) return $this->failed();

        return $this->token->access_token;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        if (!$this->token) return $this->failed();

        return $this->token->token_type;
    }

    /**
     * @return mixed
     */
    public function getExpireIn()
    {
        if (!$this->token) return $this->failed();

        return $this->token->expires_in;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        if (!$this->token) return $this->failed();

        return $this->token->scope;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        if (!$this->token) return $this->failed();

        return $this->token->user_id;
    }

    /**
     * @return mixed Retorna o code para alterar o token do usuario
     */
    public function getRefreshToken()
    {
        if (!$this->token) return $this->failed();

        return $this->token->refresh_token;
    }

    public function user()
    {
        return new User($this->token);
    }

    /**
     * @return Site
     */
    public function site()
    {
        return new Site();
    }

    public function products()
    {
        return new Search();
    }


}
