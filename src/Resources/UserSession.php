<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Resources\AbstractResource;

/**
 * Session management
 *
 * This provides methods to login and logout user
 *
 * @package Matrix\Resources
 */
class UserSession extends AbstractResource
{
    /**
     * The resource endpoint
     *
     * @internal
     * @var string
     */
    protected $endpoint = '';

    /**
     * Authenticates the user, and issues an access token they can use to authorize themself in subsequent requests.
     *
     * @param  string $username The username
     * @param  string $password The password
     * @return JSON             Authenticated user
     */
    public function login($username, $password)
    {
        $data = $this->matrix()->request('POST', $this->endpoint('login'), [
            'type' => 'm.login.password',
            'user' => $username,
            'password' => $password
        ]);
        $this->setData($data);
        return $this->data;
    }

    /**
     * Invalidates an existing access token, so that it can no longer be used for authorization.
     *
     * @param  string $token The access token
     * @return JSON          Empty json
     */
    public function logout()
    {
        if ($this->check()) {
            $this->matrix()->request('POST', $this->endpoint('logout'), [], [
                'access_token' => $this->data['access_token']
            ]);
            $this->setData(null);
            return true;
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Check if user is logged in
     *
     * @return boolean
     */
    public function check()
    {
        return $this->check();
    }

    /**
     * Get logged in user data
     *
     * @return Array
     */
    public function user()
    {
        if ($this->check()) {
            return $this->data;
        }
        throw new \Exception('Not authenticated');
    }
}
