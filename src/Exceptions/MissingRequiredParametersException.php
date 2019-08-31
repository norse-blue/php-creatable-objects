<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Exception thrown when a call to the constructor is made with missing required parameters.
 */
final class MissingRequiredParametersException extends RuntimeException
{
    /** @var int Number of given parameters. */
    private $givenParams;

    /** @var int Number of required parameters. */
    private $requiredParams;

    public function __construct(
        string $message = "",
        int $requiredParams = 0,
        int $givenParams = 0,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        $this->requiredParams = $requiredParams;
        $this->givenParams = $givenParams;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the call given parameter count.
     *
     * @return int
     */
    public function getGivenParams(): int
    {
        return $this->givenParams;
    }

    /**
     * Gets the call required parameter count.
     *
     * @return int
     */
    public function getRequiredParams(): int
    {
        return $this->requiredParams;
    }
}
