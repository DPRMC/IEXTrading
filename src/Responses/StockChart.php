<?php

namespace DPRMC\IEXTrading\Responses;

use DPRMC\IEXTrading\Exceptions\InvalidRangeReturnedInDynamicChart;
use DPRMC\IEXTrading\Exceptions\InvalidStockChartOption;
use Illuminate\Support\Collection;

class StockChart extends IEXTradingResponse {

    const OPTION_5Y      = '5y';
    const OPTION_2Y      = '2y';
    const OPTION_1Y      = '1y';
    const OPTION_YTD     = 'ytd';
    const OPTION_6M      = '6m';
    const OPTION_3M      = '3m';
    const OPTION_1M      = '1m';
    const OPTION_1D      = '1d';
    const OPTION_DATE    = 'date';
    const OPTION_DYNAMIC = 'dynamic';

    public $option;
    public $date;
    public $range;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $data;


    /**
     * StockChart constructor.
     *
     * @param      $response
     * @param      $option
     * @param null $date
     *
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidRangeReturnedInDynamicChart
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidStockChartOption
     */
    public function __construct( $response, $option, $date = null ) {
        $this->option = $option;
        $this->date   = $date;
        $jsonString   = (string)$response->getBody();
        $a            = \GuzzleHttp\json_decode( $jsonString, true );
        $this->data   = new Collection();
        switch ( $option ):
            case StockChart::OPTION_5Y:
            case StockChart::OPTION_2Y:
            case StockChart::OPTION_1Y:
            case StockChart::OPTION_YTD:
            case StockChart::OPTION_6M:
            case StockChart::OPTION_3M:
            case StockChart::OPTION_1M:
                foreach ( $a as $dataPoint ):
                    $this->data->push( new StockChartDay( $dataPoint ) );
                endforeach;
                break;

            case StockChart::OPTION_1D:
            case StockChart::OPTION_DATE:
                foreach ( $a as $dataPoint ):
                    $this->data->push( new StockChartIntraDay( $dataPoint ) );
                endforeach;
                break;

            case StockChart::OPTION_DYNAMIC:
                $this->range = $a[ 'range' ];
                switch ( $this->range ):
                    case '1d':
                        $stockChartObjectName = StockChartDay::class;
                        break;
                    case 'today':
                    case '1m':
                        $stockChartObjectName = StockChartIntraDay::class;
                        break;
                    default:
                        throw new InvalidRangeReturnedInDynamicChart( "The IEX system returned a range of [" . $this->range . "] which isn't handled by this library yet. Contact the dev." );
                endswitch;
                foreach ( $a[ 'data' ] as $dataPoint ):
                    $this->data->push( new $stockChartObjectName( $dataPoint ) );
                endforeach;
                break;

            default:
                throw new InvalidStockChartOption( "You passed in [" . $option . "] as an option. Valid values are 5y, 2y, 1y, ytd, 6m, 3m, 1m, 1d, date, and dynamic." );

        endswitch;

    }

}