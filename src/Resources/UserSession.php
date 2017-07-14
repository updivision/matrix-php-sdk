<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Resources\AbstractResource;

/**
 * Session management
 *
 * This provides methods to login, logout and refresh token
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
     * The session
     *
     * @internal
     * @var array | null
     */
    protected $session = null;

    public function login($username, $password)
    {
        $user = $this->matrix()->request('POST', $this->endpoint('login'), [
            'type' => 'm.login.password',
            'user' => $username,
            'password' => $password
        ]);
        return $this->setSession($user);
    }

    public function logout()
    {
        $sess = $this->getSession();
        dd($sess);
        return $this->matrix()->request('POST', $this->endpoint('logout'), [], ['access_token' => $this->session['access_token']]);
    }

    public function tokenrefresh()
    {

    }

    private function getSession()
    {
        $this->session = session('updivision_matrix');
        dd(session('updivision_matrix'));
        return $this->session;
    }

    private function setSession($data)
    {
        session(['updivision_matrix' => $data]);
        dd(session('updivision_matrix'));
        $this->session = $data;

        return $this->session;
    }
}
