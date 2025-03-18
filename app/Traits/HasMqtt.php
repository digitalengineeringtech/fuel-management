<?php

namespace App\Traits;

use Hakhant\Broker\Client;

trait HasMqtt
{
    public function splitTopic(string $topic): array
    {
        return explode('/', $topic);
    }

    public function splitMessage(string $message)
    {
        // 01S10000.L3.92P3320T12345.533A123456
        // i want only numbers from the string
        preg_match_all('/\d+(\.\d+)?/', $message, $matches);

        return $matches[0];
    }

    public function getClient()
    {
        $retry = 3;
        $mqttOne = config('mqtt.default');
        $mqttTwo = config('mqtt.mqtt-two');

        $configs = $this->handleConnectionWithRetry($mqttOne, $retry);

        if (! $configs) {
            echo 'Connection to mqtt service one failed.Attempting to connect to mqtt service two...';
            $configs = $this->handleConnectionWithRetry($mqttTwo, $retry);

            if (! $configs) {
                echo 'Connection to mqtt service two failed. Retrying with mqtt service one...';
                $this->handleConnectionWithRetry($mqttOne, $retry);
            }
        }

        $client = new Client($configs);

        return $client;
    }

    /**
     * Attempt to connect to the MQTT broker with retries.
     *
     * @param  array  $mqttConfig
     * @param  int  $retry
     * @return array|null
     */
    protected function handleConnectionWithRetry($mqttConfig, $retry = 3)
    {
        $attempts = 0;

        while ($attempts < $retry) {

            // Check if the MQTT port is open
            if ($this->checkConnection($mqttConfig['host'], $mqttConfig['port'])) {
                return $mqttConfig;  // Return the config if connection is successful
            }

            // Connection failed, retry logic
            $attempts++;

            // If we have not reached the max retries, wait a moment and retry
            if ($attempts < $retry) {
                sleep(1); // Add a 1-second delay before retrying
            }
        }

        // Return null if we failed to connect after retries
        return null;
    }

    /**
     * Check if a connection can be established to the given host and port.
     *
     * @param  string  $host
     * @param  int  $port
     * @param  int  $timeout
     * @return bool
     */
    protected function checkConnection($host, $port, $timeout = 2)
    {
        // Try to open a socket to the MQTT broker host and port
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);

        if ($connection) {
            fclose($connection);

            return true;  // Successfully connected
        }

        // Connection failed
        return false;
    }
}
