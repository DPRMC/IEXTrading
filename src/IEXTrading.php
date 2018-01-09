<?php

namespace DPRMC\IEXTrading;

use GuzzleHttp\Client;

class IEXTrading {

    const URL = 'https://api.iextrading.com/1.0';

    /**
     * @param $ticker
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @url /stock/aapl/stats
     */
    public static function stockStats( $ticker ) {
        $client = IEXTrading::getClient();

        return $client->request( 'GET', URL . '/stock/' . $ticker . '/stats' );
    }

    protected static function getClient() {
        return new Client();
    }

}