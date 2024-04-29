<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\TextUI\TestRunner;

if (getenv('APP_ENV') !== 'prod') {
	$suite = new TestSuite('My Test Suite');

	// Adicionar testes
	$suite->addTestSuite(Tests\NumberComparatorTest::class);

	// Executar testes
	$runner = new TestRunner();
	$result = $runner->run($suite, ['verbose' => true]);

	// Imprimir resultados (opcional, pode usar um ResultPrinter customizado)
	$printer = new ResultPrinter();
	$printer->printResult($result);
} else {
	echo "Test runner is not available in the production environment.";
}
