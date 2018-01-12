<?php

use DPRMC\IEXTrading\IEXTrading;
use PHPUnit\Framework\TestCase;

class IEXTradingTest extends TestCase {

    public function testStockStatsWithInvalidTicker() {
        $this->expectException( \DPRMC\IEXTrading\Exceptions\UnknownSymbol::class );
        IEXTrading::stockStats( 'thisisafaketicker' );
    }

    public function testStockStats() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockStats $stockStats
         */
        $stockStats = IEXTrading::stockStats( 'aapl' );
        $this->assertEquals( 'Apple Inc.', $stockStats->companyName );
    }

    public function testStockQuote() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockQuote $stockQuote
         */
        $stockQuote = IEXTrading::stockQuote( 'aapl' );
        $this->assertEquals( 'Apple Inc.', $stockQuote->companyName );
    }


    /**
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidStockChartOption
     * @throws \Exception
     * @group chart
     */
    public function testStockChart() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_1M );
        print_r( $stockChart );

    }

}