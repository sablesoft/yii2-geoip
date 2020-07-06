<?php declare(strict_types=1);

namespace sablesoft\geoip;

use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * Class IpData
 * @package sablesoft\geoip
 *
 * @property null|string $cityName
 * @property null|string $countryName
 * @property null|string $countryCode
 */
class IpData extends BaseObject
{
    const DATA_CITY_NAME = 'city.names';
    const DATA_COUNTRY_NAME = 'country.names';
    const DATA_COUNTRY_CODE = 'country.iso_code';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * IpData constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->data = (array) $config;
        parent::__construct();
    }

    /**
     * @param string $path
     * @param null $default
     * @return mixed|null
     */
    public function get(string $path, $default = null)
    {
        return ArrayHelper::getValue($this->data, $path, $default);
    }

    /**
     * @return string|null
     */
    public function getCityName() : ?string
    {
        return $this->get(static::DATA_CITY_NAME .".". $this->lang());
    }

    /**
     * @return string|null
     */
    public function getCountryName() : ?string
    {
        return $this->get(static::DATA_COUNTRY_NAME .".". $this->lang());
    }

    /**
     * @return string|null
     */
    public function getCountryCode() : ?string
    {
        return $this->get(static::DATA_COUNTRY_CODE);
    }

    /**
     * @return string
     */
    protected function lang() : string
    {
        $lang = \Yii::$app->language;
        $parts = explode('-', $lang);
        return strtolower($parts[0]);
    }
}
