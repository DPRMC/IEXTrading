<?php

namespace DPRMC\IEXTrading\Responses;

use Carbon\Carbon;

class StockQuote extends IEXTradingResponse {

    public $symbol;
    public $companyName;
    public $primaryExchange;
    public $sector;
    public $calculationPrice;
    public $open;
    public $openTime;
    public $close;
    public $closeTime;
    public $latestPrice;
    public $latestSource;
    public $latestTime;
    public $latestUpdate;
    public $latestVolume;
    public $iexRealtimePrice;
    public $iexRealtimeSize;
    public $iexLastUpdated;
    public $delayedPrice;
    public $delayedPriceTime;
    public $previousClose;
    public $change;
    public $changePercent;
    public $iexMarketPercent;
    public $iexVolume;
    public $avgTotalVolume;
    public $iexBidPrice;
    public $iexBidSize;
    public $iexAskPrice;
    public $iexAskSize;
    public $marketCap;
    public $peRatio;
    public $week52High;
    public $week52Low;
    public $ytdChange;

    // Carbon Dates
    public $carbonOpenTime;
    public $carbonCloseTime;
    public $carbonLatestUpdate;
    public $carbonIexLastUpdated;
    public $carbonDelayedPriceTime;


    /**
     * StockQuote constructor.
     *
     * @param $response
     */
    public function __construct( $response ) {
        $jsonString             = (string)$response->getBody();
        $a                      = \GuzzleHttp\json_decode( $jsonString, true );
        $this->symbol           = $a[ 'symbol' ];
        $this->companyName      = $a[ 'companyName' ];
        $this->primaryExchange  = $a[ 'primaryExchange' ];
        $this->sector           = $a[ 'sector' ];
        $this->calculationPrice = $a[ 'calculationPrice' ];
        $this->open             = $a[ 'open' ];
        $this->openTime         = $a[ 'openTime' ];
        $this->close            = $a[ 'close' ];
        $this->closeTime        = $a[ 'closeTime' ];
        $this->latestPrice      = $a[ 'latestPrice' ];
        $this->latestSource     = $a[ 'latestSource' ];
        $this->latestTime       = $a[ 'latestTime' ];
        $this->latestUpdate     = $a[ 'latestUpdate' ];
        $this->latestVolume     = $a[ 'latestVolume' ];
        $this->iexRealtimePrice = $a[ 'iexRealtimePrice' ];
        $this->iexRealtimeSize  = $a[ 'iexRealtimeSize' ];
        $this->iexLastUpdated   = $a[ 'iexLastUpdated' ];
        $this->delayedPrice     = $a[ 'delayedPrice' ];
        $this->delayedPriceTime = $a[ 'delayedPriceTime' ];
        $this->previousClose    = $a[ 'previousClose' ];
        $this->change           = $a[ 'change' ];
        $this->changePercent    = $a[ 'changePercent' ];
        $this->iexMarketPercent = $a[ 'iexMarketPercent' ];
        $this->iexVolume        = $a[ 'iexVolume' ];
        $this->avgTotalVolume   = $a[ 'avgTotalVolume' ];
        $this->iexBidPrice      = $a[ 'iexBidPrice' ];
        $this->iexBidSize       = $a[ 'iexBidSize' ];
        $this->iexAskPrice      = $a[ 'iexAskPrice' ];
        $this->iexAskSize       = $a[ 'iexAskSize' ];
        $this->marketCap        = $a[ 'marketCap' ];
        $this->peRatio          = $a[ 'peRatio' ];
        $this->week52High       = $a[ 'week52High' ];
        $this->week52Low        = $a[ 'week52Low' ];
        $this->ytdChange        = $a[ 'ytdChange' ];

        $this->carbonOpenTime         = Carbon::createFromTimestampUTC( $this->openTime );
        $this->carbonCloseTime        = Carbon::createFromTimestampUTC( $this->closeTime );
        $this->carbonLatestUpdate     = Carbon::createFromTimestampUTC( $this->latestUpdate );
        $this->carbonIexLastUpdated   = Carbon::createFromTimestampUTC( $this->iexLastUpdated );
        $this->carbonDelayedPriceTime = Carbon::createFromTimestampUTC( $this->delayedPriceTime );
    }

}