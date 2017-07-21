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
     * The resource endpoint
     *
     * @internal
     * @var string
     */
    protected $data = null;

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
        $this->data = session('updivision_matrix_data');
    }

    /**
     * Creates the endpoint
     *
     * @param null $resId The endpoint terminator
     * @return string
     * @internal
     *
     */
    protected function endpoint($resId = null)
    {
        return $resId === null ? $this->endpoint : $this->endpoint . '/' . $resId;
    }

    /**
     * @return Matrix
     * @internal
     */
    protected function matrix()
    {
        return $this->matrix;
    }

    protected function setData($data)
    {
        session(['updivision_matrix_data' => $data]);
        $this->data = $data;
    }

    protected function getData()
    {
        return $this->data;
    }

    public function check()
    {
        return $this->data !== null;
    }
}
