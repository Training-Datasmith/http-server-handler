<?php

require __DIR__ . '/../vendor/autoload.php';

use HttpServerHandler\Tests\RequestHandlerInterfaceTest;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

$declarationOrder = array(
    'testInterfaceIsLoadableFromPsr4',
    'testInterfaceHasNoParentsOrConstants',
    'testHandleIsTheOnlyMethod',
    'testHandleParameterContract',
    'testHandleReturnTypeContract',
    'testConformingHandlerReturnMatchesDeclaredType',
);

$seed = isset($argv[1]) ? (int) $argv[1] : 20261008;
$methods = $declarationOrder;

mt_srand($seed);
for ($i = count($methods) - 1; $i > 0; $i--) {
    $j = mt_rand(0, $i);
    $tmp = $methods[$i];
    $methods[$i] = $methods[$j];
    $methods[$j] = $tmp;
}

if ($methods === $declarationOrder) {
    fwrite(STDERR, 'reorder_error: shuffled order matches declaration order' . PHP_EOL);
    exit(1);
}

echo 'reorder_seed=' . $seed . PHP_EOL;
echo 'reorder_order=' . implode(' ', $methods) . PHP_EOL;

$suite = new TestSuite('ReorderedRequestHandlerInterface');
$class = new ReflectionClass(RequestHandlerInterfaceTest::class);

foreach ($methods as $methodName) {
    if (!$class->hasMethod($methodName)) {
        fwrite(STDERR, 'reorder_error: missing method ' . $methodName . PHP_EOL);
        exit(1);
    }
    $suite->addTest(TestSuite::createTest($class, $methodName));
}

if ($suite->count() !== 6) {
    fwrite(STDERR, 'reorder_error: expected 6 tests in suite, got ' . $suite->count() . PHP_EOL);
    exit(1);
}

$configuration = dirname(__DIR__) . '/phpunit.xml.dist';
$runner = new TestRunner();
$result = $runner->doRun(
    $suite,
    array('configuration' => $configuration),
    false
);

if ($result->count() !== 6) {
    fwrite(STDERR, 'reorder_error: expected 6 tests executed, got ' . $result->count() . PHP_EOL);
    exit(1);
}

if (!$result->wasSuccessful()) {
    exit(1);
}

exit(0);
