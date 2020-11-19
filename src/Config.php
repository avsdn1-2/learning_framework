<?php


namespace Framework;


use Exception;
use Framework\Exception\Config\ConfigFileNotExistsException;
use Framework\Exception\Config\InvalidConfigException;

final class Config
{
   /**
     * Load configuration from file.
     *
     * @param string $configFile
     * @throws ConfigFileNotExistsException
     * @throws InvalidConfigException
     */
    public function load($configFile): array
    {
        if (!file_exists($configFile)) {
            throw new ConfigFileNotExistsException(sprintf('File <%s> doesnt exists', $configFile));
        }

        $config = parse_ini_file($configFile, true);
        if (empty($config)) {
            throw new InvalidConfigException('Invalid configuration');
        }

        return $config;
    }
}