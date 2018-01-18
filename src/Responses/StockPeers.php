<?php

namespace DPRMC\IEXTrading\Responses;

/**
 * Class StockPeers
 * An array of peer tickers as defined by IEX. This is not intended to represent a definitive or accurate list of
 * peers, and is subject to change at any time.
 * @package DPRMC\IEXTrading\Responses
 * @link    https://iextrading.com/developer/docs/#peers
 */
class StockPeers extends IEXTradingResponse {

    public $symbols;


    public function __construct( $response ) {
        $jsonString = (string)$response->getBody();
        $a          = \GuzzleHttp\json_decode( $jsonString, true );
        foreach ( $a as $peer ):
            $this->symbols[] = $peer;
        endforeach;
    }

}