<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Authentication Exception
 *
 * Thrown when the Matrix API returns a 401 error,
 * which indicates that the Authorization header is either missing or incorrect
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class AuthenticationException extends ApiException
{
}
