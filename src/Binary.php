<?php


namespace Bysqr;


use RuntimeException;
use Symfony\Component\Process\Process;
use Throwable;

class Binary
{
    public function __construct(
        protected string $path,
    ) { }

    /**
     * Run encode command through the binary.
     */
    public function encode(array $args): string
    {
        $process = new Process([$this->path, 'encode', ...$args]);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new RuntimeException("Unable to run bysqr binary: {$process->getErrorOutput()}");
        }

        return $process->getOutput();
    }

    /**
     * Determine whether supported binary is shipped with the package.
     */
    public static function supported(): bool
    {
        try {
            static::get();

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Determine whether package is unsupported on the running OS.
     */
    public static function unsupported(): bool
    {
        return ! static::supported();
    }

    /**
     * Create new instance to the bysqr binary.
     */
    public static function get(): static
    {
        $uname = php_uname();

        if (str_contains($uname, "Darwin")) {
            if (str_contains(php_uname("m"), 'arm64')) {
                return new static(realpath(__DIR__.'/../bin/bysqr-darwin-arm64'));
            }
        }

        throw new RuntimeException("The architecture is not supported.");
    }
}
