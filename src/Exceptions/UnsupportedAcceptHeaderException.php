<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Unsupported Accept Header Exception
 *
 * Thrown when the Matrix API returns a 406 code. Only application/json and '*\/*' are supported.
 * When uploading files multipart/form-data is supported
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class UnsupportedAcceptHeaderException extends ApiException
{

}
