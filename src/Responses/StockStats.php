<?php

namespace DPRMC\IEXTrading\Responses;

class StockStats extends IEXTradingResponse {
    public $companyName;
    public $marketcap;
    public $beta;
    public $week52high;
    public $week52low;
    public $week52change;
    public $shortInterest;
    public $shortDate;
    public $dividendRate;
    public $dividendYield;
    public $exDividendDate;
    public $latestEPS;
    public $latestEPSDate;
    public $sharesOutstanding;
    public $float;
    public $returnOnEquity;
    public $consensusEPS;
    public $numberOfEstimates;
    public $symbol;
    public $EBITDA;
    public $revenue;
    public $grossProfit;
    public $cash;
    public $debt;
    public $ttmEPS;
    public $revenuePerShare;
    public $revenuePerEmployee;
    public $peRatioHigh;
    public $peRatioLow;
    public $EPSSurpriseDollar;
    public $EPSSurprisePercent;
    public $returnOnAssets;
    public $returnOnCapital;
    public $profitMargin;
    public $priceToSales;
    public $priceToBook;
    public $day200MovingAvg;
    public $day50MovingAvg;
    public $institutionPercent;
    public $insiderPercent;
    public $shortRatio;
    public $year5ChangePercent;
    public $year2ChangePercent;
    public $year1ChangePercent;
    public $ytdChangePercent;
    public $month6ChangePercent;
    public $month3ChangePercent;
    public $month1ChangePercent;
    public $day5ChangePercent;


    /**
     * StockStats constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct( $response ) {
        $jsonString                = (string)$response->getBody();
        $a                         = \GuzzleHttp\json_decode( $jsonString, true );
        $this->companyName         = $a[ 'companyName' ];
        $this->marketcap           = $a[ 'marketcap' ];
        $this->beta                = $a[ 'beta' ];
        $this->week52high          = $a[ 'week52high' ];
        $this->week52low           = $a[ 'week52low' ];
        $this->week52change        = $a[ 'week52change' ];
        $this->shortInterest       = $a[ 'shortInterest' ];
        $this->shortDate           = $a[ 'shortDate' ];
        $this->dividendRate        = $a[ 'dividendRate' ];
        $this->dividendYield       = $a[ 'dividendYield' ];
        $this->exDividendDate      = $a[ 'exDividendDate' ];
        $this->latestEPS           = $a[ 'latestEPS' ];
        $this->latestEPSDate       = $a[ 'latestEPSDate' ];
        $this->sharesOutstanding   = $a[ 'sharesOutstanding' ];
        $this->float               = $a[ 'float' ];
        $this->returnOnEquity      = $a[ 'returnOnEquity' ];
        $this->consensusEPS        = $a[ 'consensusEPS' ];
        $this->numberOfEstimates   = $a[ 'numberOfEstimates' ];
        $this->symbol              = $a[ 'symbol' ];
        $this->EBITDA              = $a[ 'EBITDA' ];
        $this->revenue             = $a[ 'revenue' ];
        $this->grossProfit         = $a[ 'grossProfit' ];
        $this->cash                = $a[ 'cash' ];
        $this->debt                = $a[ 'debt' ];
        $this->ttmEPS              = $a[ 'ttmEPS' ];
        $this->revenuePerShare     = $a[ 'revenuePerShare' ];
        $this->revenuePerEmployee  = $a[ 'revenuePerEmployee' ];
        $this->peRatioHigh         = $a[ 'peRatioHigh' ];
        $this->peRatioLow          = $a[ 'peRatioLow' ];
        $this->EPSSurpriseDollar   = $a[ 'EPSSurpriseDollar' ];
        $this->EPSSurprisePercent  = $a[ 'EPSSurprisePercent' ];
        $this->returnOnAssets      = $a[ 'returnOnAssets' ];
        $this->returnOnCapital     = $a[ 'returnOnCapital' ];
        $this->profitMargin        = $a[ 'profitMargin' ];
        $this->priceToSales        = $a[ 'priceToSales' ];
        $this->priceToBook         = $a[ 'priceToBook' ];
        $this->day200MovingAvg     = $a[ 'day200MovingAvg' ];
        $this->day50MovingAvg      = $a[ 'day50MovingAvg' ];
        $this->institutionPercent  = $a[ 'institutionPercent' ];
        $this->insiderPercent      = $a[ 'insiderPercent' ];
        $this->shortRatio          = $a[ 'shortRatio' ];
        $this->year5ChangePercent  = $a[ 'year5ChangePercent' ];
        $this->year2ChangePercent  = $a[ 'year2ChangePercent' ];
        $this->year1ChangePercent  = $a[ 'year1ChangePercent' ];
        $this->ytdChangePercent    = $a[ 'ytdChangePercent' ];
        $this->month6ChangePercent = $a[ 'month6ChangePercent' ];
        $this->month3ChangePercent = $a[ 'month3ChangePercent' ];
        $this->month1ChangePercent = $a[ 'month1ChangePercent' ];
        $this->day5ChangePercent   = $a[ 'day5ChangePercent' ];
    }

}