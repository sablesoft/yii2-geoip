Yii2 GeoIP
===================


Installation
------------

The preferred way to install the **geoip** is through [composer](http://getcomposer.org/download/).

Either run

```
composer require sablesoft/yii2-geoip
```

or add

```json
"sablesoft/yii2-geoip": "*",
```

to the require section of your composer.json.

Then add **geoip** in your app config:

```php
    'components' => [
        'geoip'   => [
            'class'      => 'sablesoft\geoip\GeoIP',
            'dbPath'     => '/path/to/your/geoip/database'
        ]
    ]
```

## How to Use

Use `get` method to get IP data:

```php
$ip = "52.141.159.163";
/** @var \sablesoft\geoip\IpData $ipData */
$ipData = \Yii::$app->geoip->get($ip);
$country = $ipData->countryName;
$city   = $ipData->cityName;
$code = $ipData->countryCode;

$default = false;
$path = "some.path.in.ip.data.array";
$someData = $ipData->get($path, $default);
```

