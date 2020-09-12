<?php


namespace App;


use App\Api\Application;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;


final class Site
{
    private $app;
    private $url;

    /**
     * Site constructor.
     */
    public function __construct()
    {
        $this->app = new Application;
        $this->url = $this->app->getCore();
    }

    /**
     * @return object
     */
    public function all()
    {
        $http = Http::get($this->url->sites());

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param $url
     * @return object
     */
    public function getDomains($url)
    {
        $http = Http::get($this->url->domains($url));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $siteId
     * @return object
     */
    public function getListingTypes(string $siteId = null)
    {
        $http = Http::get($this->url->categories($siteId));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getListingExposures(array $params = [], string $siteId = null)
    {
        $http = Http::get($this->url->listingExposures($siteId), $params);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param array $params
     * @param string|null $siteId
     * @return object
     */

    public function getListingPrices(array $params = [], string $siteId = null)
    {
        $http = Http::get($this->url->listingPrices($siteId), $params);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());

        return $http->object();
    }

    /**
     * @param array $params
     * @param string|null $siteId
     * @return object
     */
    public function getCategories(array $params = [], string $siteId = null)
    {

        $http = Http::get($this->url->categories($siteId), $params);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param $categoryId
     * @return object
     */
    public function getCategory($categoryId)
    {
        $http = Http::get($this->url->category($categoryId));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param $categoryId
     * @return object
     */
    public function getCategoryAttributes($categoryId)
    {
        $http = Http::get($this->url->categoryAttributes($categoryId));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $title
     * @param string|null $siteId
     * @return object
     */
    public function getPredictorCategory(string $title, string $siteId = null)
    {
        $http = Http::get($this->url->predictorCategory($siteId), [
            'title' => urlencode($title)
        ]);

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());

        return $http->object();
    }

    /**
     * @param string $categoryId
     * @return object
     */
    public function getClassFieldsPromotions(string $categoryId)
    {
        $http = Http::get($this->url->categoriesPromotions($categoryId));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }

    /**
     * @param string $listingTypeId
     * @param string|null $siteId
     * @return object
     */
    public function getConfigListing(string $listingTypeId, string $siteId = null)
    {
        $http = Http::get($this->url->categoryListingTypes($listingTypeId, $siteId));

        if ($http->failed() && $http->serverError()) throw new Exception($http->body());
        return $http->object();
    }
}
