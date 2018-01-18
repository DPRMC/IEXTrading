<?php

namespace DPRMC\IEXTrading\Responses;

class StockLogo extends IEXTradingResponse {

    public $url;

    public function __construct( $response ) {
        $jsonString = (string)$response->getBody();
        $a          = \GuzzleHttp\json_decode( $jsonString, true );
        $this->url  = $a[ 'url' ];
    }

}