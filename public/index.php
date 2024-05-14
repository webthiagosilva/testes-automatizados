<?php

declare(strict_types=1);

error_reporting(E_ALL & ~E_WARNING);
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;
use PHPUnit\Util\TestDox\HtmlResultPrinter;
use Tests\Feature\MultipleSumCalculatorTest;
use Tests\Feature\HappyNumberCalculatorTest;
use Tests\Feature\WordPropertiesCheckerTest;
use Tests\Unit\MultipleStrategiesTest;
use Tests\Unit\NumberUtilTest;
use Tests\Unit\WordToNumberConverterTest;

$suite = new TestSuite('My Test Suite');
$suite->addTestSuite(MultipleSumCalculatorTest::class);
$suite->addTestSuite(HappyNumberCalculatorTest::class);
$suite->addTestSuite(WordPropertiesCheckerTest::class);
$suite->addTestSuite(NumberUtilTest::class);
$suite->addTestSuite(MultipleStrategiesTest::class);
$suite->addTestSuite(WordToNumberConverterTest::class);

$htmlOutputFile = __DIR__ . '/test-results.html';
$htmlPrinter = new HtmlResultPrinter($htmlOutputFile);

$arguments = [
    'verbose' => true,
    'colors' => 'always',
    'testdoxHTMLFile' => $htmlOutputFile,
    'cacheResultFile' => __DIR__ . '/../.phpunit.result.cache',
];

$runner = new TestRunner();
$runner->run($suite, $arguments, [], false);

if (file_exists($htmlOutputFile)) {
    echo file_get_contents($htmlOutputFile);
} else {
    echo "Unable to generate test results file.";
}
