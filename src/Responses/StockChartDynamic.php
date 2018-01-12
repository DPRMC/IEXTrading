<?php

namespace DPRMC\IEXTrading\Responses;

class StockChartDynamic extends StockChartData {

    /**
     * @var string $range
     */
    public $range;

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