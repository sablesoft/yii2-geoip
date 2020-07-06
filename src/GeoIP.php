<?php declare(strict_types=1);

namespace sablesoft\geoip;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use MaxMind\Db\Reader;

/**
 * Class GeoIP
 */
class GeoIP extends Component {

    /**
     * @var string
     */
    public ?string $dbPath = null;
    
    /**
     * @var Reader
     */
    protected ?Reader $reader = null;

    /**
     * @var array
     */
    protected array $results = [];

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     * @throws Reader\InvalidDatabaseException
     */
    public function init() {
        if (!$this->dbPath) {
            throw new InvalidConfigException("GeoIP database path is required for this component!");
        }
        $path = Yii::getAlias($this->dbPath);
        $this->reader = new Reader($path);

        parent::init();
    }

    /**
     * @param string|null $ip
     * @return IpData|null
     * @throws Reader\InvalidDatabaseException
     */
    public function get($ip = null) : ?IpData
    {
        $ip = $ip ?? Yii::$app->request->getUserIP();
        if (!array_key_exists($ip, $this->results)) {
            $data = $this->reader->get($ip);
            $this->results[$ip] = $data ? new IpData($data) : null;
        }

        return $this->results[$ip];
    }
}
