<?php

namespace App\Traits;

trait HasMqtt
{
    /**
     * Attempt to connect to the MQTT broker with retries.
     *
     * @param array $mqttConfig
     * @param int $retry
     * @return array|null
     */
    public function handleConnectionWithRetry($mqttConfig, $retry = 3)
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
     * @param string $host
     * @param int $port
     * @param int $timeout
     * @return bool
     */
    public function checkConnection($host, $port, $timeout = 2)
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
