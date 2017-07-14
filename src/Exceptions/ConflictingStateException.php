<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Conflicting State Exception
 *
 * Thrown when the Matrix API returns a 409 code. The resource that is being created/updated is in an inconsistent
 * or conflicting state.
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class ConflictingStateException extends ApiException
{

}
