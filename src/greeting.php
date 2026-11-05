<?php
declare(strict_types=1);

/**
 * The one piece of "business logic" in this practice app.
 * Kept in its own file so the smoke test can load it
 * without pulling in the page's HTML output.
 */
function greeting(string $name): string
{
    $name = trim($name);
    if ($name === '') {
        $name = 'world';
    }
    return 'Hello, ' . $name . '!';
}
