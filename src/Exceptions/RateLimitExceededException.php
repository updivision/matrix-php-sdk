<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Rate Limit Exceeded
 *
 * Thrown when a the Matrix API returns a 429 code. The API rate limit alloted for your Matrix domain has been
 * exhausted
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class RateLimitExceededException extends ApiException
{

}
