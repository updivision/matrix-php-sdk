<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Unsupported Content Type Exception
 *
 * Thrown when the Matrix API returns a 415 code. Content type application/xml is not supported.
 * Only application/json is supported
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class UnsupportedContentTypeException extends ApiException
{

}
