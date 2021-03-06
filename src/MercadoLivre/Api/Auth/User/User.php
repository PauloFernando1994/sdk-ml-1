<?php


namespace App\Api\Auth;


use App\Api\Application;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;


/**
 * Class User
 * @method delete()
 */
class User
{

    private $token;
    private $user;
    private $app;

    /**
     * User constructor.
     * @param object $token
     */
    public function __construct(object $token)
    {

        if (!isset($token->access_token)) throw new Exception("Token invalido");

        $this->app = new Application();
        $this->token = $token;

    }

    /**
     * @return object
     */
    public function getUserMe()
    {
        $http = Http::get($this->app->getCore()->userMe(), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @return object
     */
    public function getUserAccount()
    {
        $http = Http::get($this->app->getCore()->userAccount($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @return object
     */
    public function getAddress()
    {
        $http = Http::get($this->app->getCore()->address($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @return object
     */
    public function getBrands(array $params = [])
    {
        $http = Http::get($this->app->getCore()->brands($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @return object
     */
    public function getAcceptedPaymentMethods(array $params = [])
    {
        $http = Http::get($this->app->getCore()->accepted_payment_methods($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @return object
     */
    public function getClassifiedsPromotionPacks(array $params = [])
    {
        $http = Http::get($this->app->getCore()->classifieds_promotion_packs($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @return object
     */
    public function getAvailableListingTypes(array $params = [])
    {
        $http = Http::get($this->app->getCore()->available_listing_types($this->token->user_id), array_merge(
            [
                'access_token' => $this->token->access_token
            ], $params
        ));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @return object
     */
    public function getAvailableListingType(array $params = [])
    {
        $http = Http::get($this->app->getCore()->available_listing_type($this->token->user_id, 'gold'), array_merge(
            [
                'access_token' => $this->token->access_token
            ], $params
        ));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @return object
     */
    public function deletePermissionUser()
    {

        $http = Http::delete($this->app->getCore()->deleteApplications($this->token->user_id, $this->app->getId()), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @return object
     */
    public function getMyFeeds()
    {
        $http = Http::get($this->app->getCore()->myFeeds(), [
            'app_id' => $this->app->getId(),
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @return object
     */
    public function getMyItems()
    {
        $http = Http::get($this->app->getCore()->myItems($this->token->user_id), [
            'access_token' => $this->token->access_token
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $ids do usuario
     * @param array $params
     * @return object
     */
    public function myUsersMultiply(array $ids, array $params = [])
    {
        $http = Http::get($this->app->getCore()->myItemsMultiply(), array_merge([
            'ids' => implode(',', $ids),
            'access_token' => $this->token->access_token
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

}
