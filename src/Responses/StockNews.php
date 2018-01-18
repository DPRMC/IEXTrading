<?php

namespace DPRMC\IEXTrading\Responses;


class StockNews extends IEXTradingResponse {

    public $items;


    /**
     * StockNews constructor.
     *
     * @param $response \Psr\Http\Message\ResponseInterface
     */
    public function __construct( $response ) {
        $jsonString = (string)$response->getBody();
        $a          = \GuzzleHttp\json_decode( $jsonString, true );
        foreach ( $a as $newsItem ):
            $this->items[] = new StockNewsItem( $newsItem );
        endforeach;
    }

}