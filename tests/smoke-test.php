<?php
declare(strict_types=1);

/**
 * Minimal smoke test, no framework on purpose.
 * Run it with:  php tests/smoke-test.php
 * Exits 0 when everything passes, 1 on the first failure,
 * which is all a CI step needs to go red.
 */

require __DIR__ . '/../src/greeting.php';

$failures = 0;

function check(string $label, string $actual, string $expected): void
{
    global $failures;
    if ($actual === $expected) {
        echo "PASS: {$label}\n";
    } else {
        echo "FAIL: {$label} - expected '{$expected}', got '{$actual}'\n";
        $failures++;
    }
}

check('greets a given name', greeting('Ilham'), 'Hello, Ilham!');
check('falls back to world on empty name', greeting(''), 'Hello, world!');
check('trims surrounding spaces', greeting('  Ana  '), 'Hello, Ana!');

if ($failures > 0) {
    fwrite(STDERR, "{$failures} check(s) failed\n");
    exit(1);
}

echo "All checks passed\n";
