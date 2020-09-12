<?php


namespace App\Api;


use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class Search
{
    private $url;
    private $token;
    private $app;

    /**
     * Search constructor.
     */
    public function __construct()
    {
        $this->app = new Application;
        $this->url = $this->app->getCore();
    }

    /**
     * @param string $category
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getSearchCategory(string $category, array $params = [], string $siteId = null)
    {

        $http = Http::get($this->url->search($siteId), array_merge([
            'category' => $category
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $title
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getSearchProduct(string $title, array $params = [], string $siteId = null)
    {

        $http = Http::get($this->url->search($siteId), array_merge([
            'q' => $title
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $nickname
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getSearchNickname(string $nickname, array $params = [], string $siteId = null)
    {
        $http = Http::get($this->url->search($siteId), array_merge([
            'nickname' => $nickname
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $sellerId
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getSearchSellerId(string $sellerId, array $params = [], string $siteId = null)
    {
        $http = Http::get($this->url->search($siteId), array_merge([
            'seller_id' => $sellerId
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $sku
     * @param null $siteId
     * @param array $params
     * @return object
     */
    public function getSearchSku(string $sku, $siteId = null, array $params = [])
    {
        $http = Http::get($this->url->search($siteId), array_merge([
            'sku' => $sku
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $ids
     * @param array $attributes
     * @param array $params
     * @return object
     */
    public function myItemsMultiply(array $ids, array $attributes = [], array $params = [])
    {
        if (count($attributes) > 0) {
            $params['attributes'] = implode(',', $attributes);
        }

        $http = Http::get($this->app->getCore()->myItemsMultiply(), array_merge([
            'ids' => implode(',', $ids),
            'access_token' => $this->token->access_token
        ], $params));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }
}
