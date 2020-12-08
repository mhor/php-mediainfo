<?php

function includeIfExists($file)
{
    if (file_exists($file)) {
        return include $file;
    }
}

if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
    setlocale(LC_CTYPE, 'en_US.UTF-8');
}

if ((!$loader = includeIfExists(__DIR__.'/../vendor/autoload.php')) && (!$loader = includeIfExists(__DIR__.'/../../../.composer/autoload.php'))) {
    exit('You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL);
}

return $loader;
