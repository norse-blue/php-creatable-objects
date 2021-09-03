<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Throwable;

/**
 * Exception thrown when a call to the constructor is made with missing required parameters.
 */
final class MissingRequiredParametersException extends RuntimeException
{
    /** @var int Number of given parameters. */
    private int $given_params;

    /** @var int Number of required parameters. */
    private int $required_params;

    #[Pure]
    public function __construct(
        string $message = '',
        int $required_params = 0,
        int $given_params = 0,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $this->required_params = $required_params;
        $this->given_params = $given_params;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the call given parameter count.
     */
    public function getGivenParams(): int
    {
        return $this->given_params;
    }

    /**
     * Gets the call required parameter count.
     */
    public function getRequiredParams(): int
    {
        return $this->required_params;
    }
}
