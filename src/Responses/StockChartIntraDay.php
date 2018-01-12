<?php

namespace DPRMC\IEXTrading\Responses;

class StockChartIntraDay extends StockChartData {

    public $minute;
    public $average;
    public $notional;
    public $numberOfTrades;

    public function __construct( array $dataPoint ) {
        parent::__construct( $dataPoint );
        $this->minute         = $dataPoint[ 'minute' ];
        $this->average        = $dataPoint[ 'average' ];
        $this->notional       = $dataPoint[ 'notional' ];
        $this->numberOfTrades = $dataPoint[ 'numberOfTrades' ];
    }
}