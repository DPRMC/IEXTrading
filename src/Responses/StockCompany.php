<?php

namespace DPRMC\IEXTrading\Responses;

class StockCompany extends IEXTradingResponse {

    public $symbol;
    public $companyName;
    public $exchange;
    public $industry;
    public $website;
    public $description;
    public $CEO;
    public $issueType;
    public $sector;

    // (blank) = Not Available, i.e., Warrant, Note, or (non-filing) Closed Ended Funds
    public $issueTypes = [
        'ad' => "American Depository Receipt (ADR’s)",
        're' => "Real Estate Investment Trust (REIT’s)",
        'ce' => "Closed end fund (Stock and Bond Fund)",
        'si' => "Secondary Issue",
        'lp' => "Limited Partnerships",
        'cs' => "Common Stock",
        'et' => "Exchange Traded Fund (ETF)",
    ];

    /**
     * StockCompany constructor.
     *
     * @param $response
     */
    public function __construct( $response ) {
        $jsonString        = (string)$response->getBody();
        $a                 = \GuzzleHttp\json_decode( $jsonString, true );
        $this->symbol      = $a[ 'symbol' ];
        $this->companyName = $a[ 'companyName' ];
        $this->exchange    = $a[ 'exchange' ];
        $this->industry    = $a[ 'industry' ];
        $this->website     = $a[ 'website' ];
        $this->description = $a[ 'description' ];
        $this->CEO         = $a[ 'CEO' ];
        $this->issueType   = $a[ 'issueType' ];
        $this->sector      = $a[ 'sector' ];
    }

}