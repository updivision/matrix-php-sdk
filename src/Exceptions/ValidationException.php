<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Validation Exception
 *
 * Thrown when the Matrix API returns a 400 code. This means the request body/query string is not in the correct
 * format.
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class ValidationException extends ApiException
{
}
