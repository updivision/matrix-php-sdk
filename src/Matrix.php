<?php

namespace Updivision\Matrix;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Updivision\Matrix\Exceptions\AccessDeniedException;
use Updivision\Matrix\Exceptions\ApiException;
use Updivision\Matrix\Exceptions\AuthenticationException;
use Updivision\Matrix\Exceptions\ConflictingStateException;
use Updivision\Matrix\Exceptions\RateLimitExceededException;
use Updivision\Matrix\Exceptions\UnsupportedContentTypeException;
use Updivision\Matrix\Resources\Room;
use Updivision\Matrix\Resources\Media;
use Updivision\Matrix\Resources\UserData;
use Updivision\Matrix\Resources\UserSession;

/**
 * Class for interacting with the Matrix.org Api
 *
 * This is the only class that should be instantiated directly. All API resources are available
 * via the relevant public properties
 *
 * @package Matrix
 * @author Alin Ghitu <alin@updivision.com>
 */
class Matrix
{
    /**
     * User session
     *
     * @matrix
     * @var UserSession
     */
    public $session;

    /**
     * @internal
     * @var Client
     */
    protected $client;

    /**
     * @internal
     * @var string
     */
    private $baseUrl;

    /**
     * @internal
     * @var string
     */
    private $domain;

    /**
     * Constructs a new matrix api instance
     *
     * @matrix
     * @param string $domain
     * @throws Exceptions\InvalidConfigurationException
     */
    public function __construct($domain)
    {
        $this->validateConstructorArgs($domain);

        $this->domain = $domain;

        $this->baseUrl = $domain.'_matrix/client/r0';

        $this->client = new Client();

        $this->setupResources();
    }


    /**
     * Internal method for handling requests
     *
     * @internal
     * @param $method
     * @param $endpoint
     * @param array|null $data
     * @param array|null $query
     * @return mixed|null
     * @throws ApiException
     * @throws ConflictingStateException
     * @throws RateLimitExceededException
     * @throws UnsupportedContentTypeException
     */
    public function request($method, $endpoint, array $data = null, array $query = null, $rawData = false)
    {
        $options = ['json' => $data];

        if ($rawData) {
            $options = $data;
        }

        if (isset($query)) {
            $options['query'] = $query;
        }

        $url = $this->baseUrl . $endpoint;

        return $this->performRequest($method, $url, $options);
    }

    /**
     * Performs the request
     *
     * @internal
     *
     * @param $method
     * @param $url
     * @param $options
     * @return mixed|null
     * @throws AccessDeniedException
     * @throws ApiException
     * @throws AuthenticationException
     * @throws ConflictingStateException
     */
    private function performRequest($method, $url, $options)
    {
        try {
            switch ($method) {
                case 'GET':
                    return json_decode($this->client->get($url, $options)->getBody(), true);
                case 'POST':
                    return json_decode($this->client->post($url, $options)->getBody(), true);
                case 'PUT':
                    return json_decode($this->client->put($url, $options)->getBody(), true);
                case 'DELETE':
                    return json_decode($this->client->delete($url, $options)->getBody(), true);
                default:
                    return null;
            }
        } catch (RequestException $e) {
            throw ApiException::create($e);
        }
    }


    /**
     * @param $domain
     * @throws Exceptions\InvalidConfigurationException
     * @internal
     *
     */
    private function validateConstructorArgs($domain)
    {
        if (!isset($domain)) {
            throw new Exceptions\InvalidConfigurationException("Domain is empty.");
        }
    }

    /**
     * @internal
     */
    private function setupResources()
    {
        $this->baseUrl = $this->domain.'_matrix/client/r0';
        // Session
        $this->session = new UserSession($this);
    }

    public function session()
    {
        return $this->session;
    }

    public function user()
    {
        $this->baseUrl = $this->domain.'_matrix/client/r0';
        return new UserData($this);
    }

    public function room()
    {
        $this->baseUrl = $this->domain.'_matrix/client/r0';
        return new Room($this);
    }

    public function media()
    {
        $this->baseUrl = $this->domain.'_matrix/media/r0';
        return new Media($this);
    }
}
