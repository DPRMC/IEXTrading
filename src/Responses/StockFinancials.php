<?php

namespace DPRMC\IEXTrading\Responses;


class StockFinancials extends IEXTradingResponse {

    public $symbol;
    public $financials;

    /**
     * StockQuote constructor.
     *
     * @param $response
     */
    public function __construct( $response ) {
        $jsonString = (string)$response->getBody();
        $a          = \GuzzleHttp\json_decode( $jsonString, true );

        $this->symbol = $a[ 'symbol' ];
        foreach ( $a[ 'financials' ] as $i => $data ):
            $this->financials[] = new StockFinancialReport( $data );
        endforeach;
    }

}