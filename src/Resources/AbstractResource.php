<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Matrix;

/**
 * Abstract Resource
 *
 * Abstract class which all resources inherit from
 *
 * @internal
 * @package Matrix\Resources
 */
abstract class AbstractResource
{

    /**
     * @var Matrix
     * @internal
     */
    private $matrix;

    /**
     * @var String
     * @internal
     */
    protected $endpoint;

    /**
     * Resource constructor
     *
     * Constructs a new resource
     *
     * @param Matrix $matrix
     * @internal
     *
     */
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    /**
     * Creates the endpoint
     *
     * @param null $id The endpoint terminator
     * @return string
     * @internal
     *
     */
    protected function endpoint($id = null)
    {
        return $id === null ? $this->endpoint : $this->endpoint . '/' . $id;
    }

    /**
     * @return Matrix
     * @internal
     */
    protected function matrix()
    {
        return $this->matrix;
    }
}
