<?php

namespace DPRMC\IEXTrading\Responses;

use Carbon\Carbon;

class StockChartIntraDay extends StockChartData {

    public $minute;
    public $average;
    public $notional;
    public $numberOfTrades;
    public $date;
    public $high;
    public $low;
    public $volume;
    public $marketHigh;
    public $marketLow;
    public $marketAverage;
    public $marketVolume;
    public $marketNotional;
    public $marketNumberOfTrades;
    public $marketChangeOverTime;

    // Carbon dates
    public $carbonDate;


    public function __construct( array $dataPoint ) {
        parent::__construct( $dataPoint );
        $this->minute               = $dataPoint[ 'minute' ];
        $this->average              = $dataPoint[ 'average' ];
        $this->notional             = $dataPoint[ 'notional' ];
        $this->numberOfTrades       = $dataPoint[ 'numberOfTrades' ];
        $this->date                 = $dataPoint[ 'date' ];
        $this->high                 = $dataPoint[ 'high' ];
        $this->low                  = $dataPoint[ 'low' ];
        $this->volume               = $dataPoint[ 'volume' ];
        $this->marketHigh           = $dataPoint[ 'marketHigh' ];
        $this->marketLow            = $dataPoint[ 'marketLow' ];
        $this->marketAverage        = $dataPoint[ 'marketAverage' ];
        $this->marketVolume         = $dataPoint[ 'marketVolume' ];
        $this->marketNotional       = $dataPoint[ 'marketNotional' ];
        $this->marketNumberOfTrades = $dataPoint[ 'marketNumberOfTrades' ];
        $this->marketChangeOverTime = $dataPoint[ 'marketChangeOverTime' ];

        $this->carbonDate = Carbon::createFromFormat( 'Ymd H:i', $dataPoint[ 'date' ] . ' ' . $dataPoint[ 'minute' ], 'EST' );
    }
}