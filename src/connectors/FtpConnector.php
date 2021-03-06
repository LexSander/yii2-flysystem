<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace creocoder\flysystem\connectors;

use League\Flysystem\Adapter\Ftp;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Object;

/**
 * FtpConnector
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class FtpConnector extends Object implements ConnectorInterface
{
    /**
     * @var string
     */
    public $host;
    /**
     * @var integer
     */
    public $port;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $root;
    /**
     * @var boolean
     */
    public $passive;
    /**
     * @var boolean
     */
    public $ssl;
    /**
     * @var integer
     */
    public $timeout;
    /**
     * @var integer
     */
    public $permPrivate;
    /**
     * @var integer
     */
    public $permPublic;
    /**
     * @var integer
     */
    public $transferMode;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->host === null) {
            throw new InvalidConfigException('The "host" property must be set.');
        }

        if ($this->root !== null) {
            $this->root = Yii::getAlias($this->root);
        }
    }

    /**
     * Establish an adapter connection.
     *
     * @return Ftp
     */
    public function connect()
    {
        $config = [];

        foreach ([
            'host',
            'port',
            'username',
            'password',
            'root',
            'passive',
            'ssl',
            'timeout',
            'permPrivate',
            'permPublic',
            'transferMode',
        ] as $name) {
            if ($this->$name !== null) {
                $config[$name] = $this->$name;
            }
        }

        return new Ftp($config);
    }
}
