<?php

namespace DPRMC\IEXTrading\Responses;


class StockRelevant extends IEXTradingResponse {

    public $peers = false;
    public $symbols;


    public function __construct( $response ) {
        $jsonString  = (string)$response->getBody();
        $a           = \GuzzleHttp\json_decode( $jsonString, true );
        $this->peers = $a[ 'peers' ] == 'true' ? true : false;

        foreach ( $a[ 'symbols' ] as $symbol ):
            $this->symbols[] = $symbol;
        endforeach;
    }

}