<?php

use DPRMC\IEXTrading\IEXTrading;
use PHPUnit\Framework\TestCase;

class IEXTradingTest extends TestCase {

    public function testStockPrice() {
        $price = IEXTrading::stockPrice( 'aapl' );
        $this->assertTrue( is_float( $price ) );
    }

    public function testStockFinancials() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockFinancials $stockFinancials
         */
        $stockFinancials = IEXTrading::stockFinancials( 'aapl' );
        $this->assertEquals( 'AAPL', $stockFinancials->symbol );
    }

    public function testStockLogo() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockLogo $stockLogo
         */
        $stockLogo = IEXTrading::stockLogo( 'aapl' );
        $this->assertEquals( 'https://storage.googleapis.com/iex/api/logos/AAPL.png', $stockLogo->url );
    }

    /**
     * @throws \DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    public function testStockNews() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockNews $stockNews
         */
        $stockNews = IEXTrading::stockNews( 'aapl', 50 );
        $this->assertCount( 50, $stockNews->items );
    }

    /**
     * https://github.com/iexg/IEX-API/issues/185
     * @throws \DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    public function testStockNewsWithNoParametersShouldReturnTenMarketNewsItems() {
        $this->markTestSkipped(
            "A bug in the API returns 11 items instead of 10."
        );
        /**
         * @var \DPRMC\IEXTrading\Responses\StockNews $stockNews
         */
        $stockNews = IEXTrading::stockNews();
        $this->assertCount( 10, $stockNews->items );

    }

    public function testStockNewsWithTooManyItemsShouldThrowException() {
        $this->expectException( \DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange::class );
        /**
         * @var \DPRMC\IEXTrading\Responses\StockNews $stockNews
         */
        IEXTrading::stockNews( 'aapl', 51 );
    }

    public function testStockNewsWithTooFewItemsShouldThrowException() {
        $this->expectException( \DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange::class );
        /**
         * @var \DPRMC\IEXTrading\Responses\StockNews $stockNews
         */
        IEXTrading::stockNews( 'aapl', -1 );
    }

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

    public function testStockCompany() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockCompany $stockCompany
         */
        $stockCompany = IEXTrading::stockCompany( 'aapl' );
        $this->assertEquals( 'http://www.apple.com', $stockCompany->website );
    }

    public function testStockPeers() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockPeers $stockPeers
         */
        $stockPeers = IEXTrading::stockPeers( 'aapl' );
        $this->assertTrue( in_array( 'MSFT', $stockPeers->symbols ) );
    }

    public function testStockRelevant() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockRelevant $stockRelevant
         */
        $stockRelevant = IEXTrading::stockRelevant( 'aapl' );
        $this->assertTrue( in_array( 'MSFT', $stockRelevant->symbols ) );
        $this->assertTrue( $stockRelevant->peers );
    }


    /**
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidStockChartOption
     * @throws \Exception
     * @group chart
     */
    public function testStockChartDynamic() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_DYNAMIC );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartDate() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_DATE, '20180103' );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartOneMonth() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_1M );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartWithInvalidOptionShouldThrowException() {
        $this->expectException( Exception::class );
        IEXTrading::stockChart( 'aapl', 'notValidOption' );
    }


}