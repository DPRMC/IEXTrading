<?php

namespace DPRMC\IEXTrading\Responses;


abstract class StockChartData {

    public $high;
    public $low;
    public $volume;
    public $label;
    public $changeOverTime;

    /**
     * StockQuote constructor.
     *
     * @param array $dataPoint
     */
    public function __construct( $dataPoint ) {

        $this->high           = $dataPoint[ 'high' ];
        $this->low            = $dataPoint[ 'low' ];
        $this->volume         = $dataPoint[ 'volume' ];
        $this->changeOverTime = $dataPoint[ 'changeOverTime' ];
    }

}