<?php

namespace Updivision\Matrix\Exceptions;

/**
 * Method Not Allowed Exception
 *
 * Thrown when the Matrix API returns a 405 code. This API request used the wrong HTTP verb/method.
 *
 * @package Exceptions
 * @author Alin Ghitu <alin@updivision.com>
 */
class MethodNotAllowedException extends ApiException
{

}
