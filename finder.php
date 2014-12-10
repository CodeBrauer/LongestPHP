<?php

/**
 * @author  CodeBrauer <hello@gabrielw.de>
 * @param array $array numerical array with items as string
 * @param int $top size of the returned array (Like TOP 10)
 * @return array names of the longest value of $array
 */
function getLongestValue($array, $top = 10) {
    usort ($array, function($a, $b) {
        return strlen($b) - strlen($a);
    });

    return array_slice($array, 0, $top);
}

$data = [
    'functions'  => get_defined_functions()['internal'],
    'constants'  => array_keys(get_defined_constants()),
    'classes'    => get_declared_classes(),
    'interfaces' => get_declared_interfaces(),
];

// generate markdown output
header('Content-Type: text/plain');

echo '**PHP Version: '.PHP_VERSION.'**';
echo "\n";
echo '**OS: '.PHP_OS.'**';

foreach ($data as $name => $array) {
    $array = getLongestValue($array);
    echo "\n\n# $name\n\n";
    foreach ($array as $key => $value) {
        $len = strlen($value);
        echo "[$len] $value\n";
    }
}
