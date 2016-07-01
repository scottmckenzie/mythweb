<?php

class Cache_Redis implements Cache_Engine {

    private $Redis = null;

    public function __construct() {
        $this->Redis = new Redis();
        $this->Redis->connect('127.0.0.1');
	$this->Redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    }

    public function __destruct() {
    }

    public function &get($key = null) {
        if (is_array($key))
            return $this->Redis->mGet($key);
        return $this->Redis->get($key);
    }

    public function set($key, $data, $lifeLength) {
        return $this->Redis->set($key, $data, $lifeLength);
    }

    public function delete($key) {
        return $this->Redis->delete($key);
    }

    public static function isEnabled() {
        if (!class_exists('Redis'))
            return false;
        return true;
    }

    public function clear() {
        return $this->Redis->flushDb();
    }
}

