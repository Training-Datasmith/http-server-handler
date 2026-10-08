#!/usr/bin/env bash
set -euo pipefail

SEED="${1:-20261008}"
exec php -d error_reporting=-1 "$(dirname "$0")/run-phpunit-reordered.php" "${SEED}"
