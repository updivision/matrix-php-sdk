<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Access Denied
 *
 * Thrown when the Matrix API returns a 403 error code. This indicates that
 * the agent whose credentials were used in making this request was not authorized to perform this API call.
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class AccessDeniedException extends ApiException
{
}
