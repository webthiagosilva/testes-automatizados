<?php

error_reporting(E_ALL & ~E_WARNING);
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;
use PHPUnit\Util\TestDox\HtmlResultPrinter;
use Tests\MultipleSumCalculatorTest;

if (getenv('APP_ENV') !== 'prod') {
    $suite = new TestSuite('My Test Suite');
    $suite->addTestSuite(MultipleSumCalculatorTest::class);

    $htmlOutputFile = __DIR__ . '/test-results.html';

    $runner = new TestRunner();

    $htmlPrinter = new HtmlResultPrinter($htmlOutputFile);

    $arguments = [
        'verbose' => true,
        'colors' => 'always',
        'testdoxHTMLFile' => $htmlOutputFile,
        'cacheResultFile' => __DIR__ . '/../.phpunit.result.cache',
    ];

    $runner->run($suite, $arguments, [], false);

    if (file_exists($htmlOutputFile)) {
        echo file_get_contents($htmlOutputFile);
    } else {
        echo "Não foi possível gerar o arquivo de resultados de teste.";
    }
} else {
    echo "Test runner is not available in the production environment.";
}
