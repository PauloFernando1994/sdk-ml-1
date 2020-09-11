<?php


namespace App\Facades;


interface UrlSite extends Message
{

    /**
     * core de cada pais
     */
    const CORE = [
        'br' => "https://api.mercadolibre.com"
    ];

    /**
     * path de busca de autorização do usuario!
     */
    const AUTH = "http://auth.mercadolibre.com/authorization?response_type=code";
    const APP = '/applications/';

}
