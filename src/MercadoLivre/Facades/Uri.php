<?php

namespace App\Facades;


use Mockery\Exception;

class Uri
{

    private $core;
    private $auth;
    private $app;


    /**
     * Uri constructor.
     * @param array $uri
     */
    public function __construct(array $uri, $app)
    {

        if (!isset($uri['core'], $uri['auth'])) throw new Exception("por favor informe a uri['core'] e uri['auth']");

        $this->core = $uri['core'];
        $this->auth = $uri['auth'];

        $this->app = $app;
    }

    /**
     * @param string $patch
     * @param bool $redirect
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function auth($patch = '/', $redirect = true)
    {

        $uri = $this->auth . '&client_id=' . $this->app->id . '&redirect_uri=' . $this->app->callback_url . $patch;

        if ($redirect) {
            return redirect()->away($uri);
        }

        return $uri;

    }

    /**
     * @return string
     */
    public function token()
    {
        return $this->core . "/oauth/token";
    }

    /**
     * @return string
     */
    public function userMe()
    {
        return $this->core . "/users/me";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function userAccount(int $userId)
    {
        return $this->core . "/users/{$userId}";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function address(int $userId)
    {
        return $this->core . "/users/{$userId}/addresses";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function brands(int $userId)
    {
        return $this->core . "/users/{$userId}/brands";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function accepted_payment_methods(int $userId)
    {
        return $this->core . "/users/{$userId}/accepted_payment_methods";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function classifieds_promotion_packs(int $userId)
    {
        return $this->core . "/users/{$userId}/classifieds_promotion_packs";
    }

    /**
     * @param int $userId
     * @return string
     */
    public function available_listing_types(int $userId)
    {
        return $this->core . "/users/{$userId}/available_listing_types";
    }

    /**
     * @param int $userId
     * @param $listingTypeId
     * @return string
     */
    public function available_listing_type(int $userId, $listingTypeId)
    {
        return $this->core . "/users/{$userId}/available_listing_type/{$listingTypeId}";
    }

    /**
     * @param int $userId
     * @param int $appId
     * @return string
     */
    public function deleteApplications(int $userId, int $appId)
    {
        return $this->core . "/users/{$userId}/applications/{$appId}";
    }

    /**
     * @return string
     */
    public function myFeeds()
    {
        return $this->core . "/myfeeds";
    }

    /**
     * @return string
     */
    public function sites()
    {
        return $this->core . '/sites';
    }

    /**
     * @param $domains
     * @return string
     */
    public function domains($domains)
    {
        return $this->core . "/site_domains/{$domains}";
    }

    /**
     * @param $siteId
     * @return string
     */
    public function listingTypes($siteId)
    {
        return $this->core . "/sites/{$siteId}/listing_types";
    }

    /**
     * @param string $siteId
     * @return string
     */
    public function listingExposures(string $siteId)
    {
        return $this->core . "/sites/{$siteId}/listing_exposures";
    }

    /**
     * @param string $siteId
     * @return string
     */
    public function listingPrices(string $siteId)
    {
        return $this->core . "/sites/{$siteId}/listing_prices";
    }

    /**
     * @param string $siteId
     * @return string
     */
    public function categories(string $siteId)
    {
        return $this->core . "/sites/{$siteId}/categories";
    }

    /**
     * @param $categoryId
     * @return string
     */
    public function category($categoryId)
    {
        return $this->core . "/categories/{string $categoryId}";
    }

    /**
     * @param string $categoryId
     * @return string
     */
    public function categoryAttributes(string $categoryId)
    {
        return $this->core . "/categories/$categoryId/attributes";
    }

    /**
     * @param string $siteId
     * @return string
     */
    public function predictorCategory(string $siteId)
    {
        return $this->core . "/sites/{$siteId}/category_predictor/predict";
    }

    /**
     * @param string $categoryId
     * @return string
     */
    public function categoriesPromotions(string $categoryId)
    {
        return $this->core . "/categories/{$categoryId}/classifieds_promotion_packs";
    }

    /**
     * @param string $siteId
     * @param string $listingTypeId
     * @return string
     */
    public function categoryListingTypes(string $siteId, string $listingTypeId)
    {
        return $this->core . "/sites/{$siteId}/listing_types/{$listingTypeId}";
    }

}


