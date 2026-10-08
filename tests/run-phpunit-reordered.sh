#!/usr/bin/env bash
set -euo pipefail

SEED="${1:-20261008}"
export SEED

ORDER="$(php -r '
$seed = (int) getenv("SEED");
$methods = array(
    "testInterfaceIsLoadableFromPsr4",
    "testInterfaceHasNoParentsOrConstants",
    "testHandleIsTheOnlyMethod",
    "testHandleParameterContract",
    "testHandleReturnTypeContract",
    "testConformingHandlerReturnMatchesDeclaredType",
);
mt_srand($seed);
for ($i = count($methods) - 1; $i > 0; $i--) {
    $j = mt_rand(0, $i);
    $tmp = $methods[$i];
    $methods[$i] = $methods[$j];
    $methods[$j] = $tmp;
}
echo implode(" ", $methods);
')"

echo "reorder_seed=${SEED}"
echo "reorder_order=${ORDER}"

for method in ${ORDER}; do
  php -d error_reporting=-1 vendor/bin/phpunit --configuration phpunit.xml.dist --filter "${method}"
done
