# IEXTrading
PHP library that provides access to the iextrading.com API.

##Usage

### Quote
```php
// https://iextrading.com/developer/docs/#quote 
$stockQuote = IEXTrading::stockQuote( 'aapl' );
echo $stockQuote->companyName; // Apple Inc.
```

### Key Stats
```php
// https://iextrading.com/developer/docs/#key-stats
$stockStats = IEXTrading::stockStats( 'aapl' );
echo $stockStats->marketcap; // 760334287200
```