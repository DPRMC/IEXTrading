# IEXTrading
PHP library that provides access to the iextrading.com API.

##Usage

```php
// https://iextrading.com/developer/docs/#quote 
$stockQuote = IEXTrading::stockQuote( 'aapl' );
echo $stockQuote->companyName; // Apple Inc.
```