<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Resources\AbstractResource;

/**
 * User data management
 *
 * This provides methods to login and logout user
 *
 * @package Matrix\Resources
 */
class UserData extends AbstractResource
{
    /**
     * The resource endpoint
     *
     * @internal
     * @var string
     */
    protected $endpoint = '';

    /**
     * Gets a list of the third party identifiers that the homeserver has associated with the user's account.
     *
     * @return mixed|null  3pid list
     * @throws Exception
     */
    public function get3pid()
    {
        if ($this->check()) {
            return $this->matrix()->request('GET', $this->endpoint('account/3pid'), [], [
                    'access_token' => $this->data['access_token']
                ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Adds contact information to the user's account.
     *
     * @param  Array $data Contact info
     * @return mixed|null        The addition was successful.
     * @throws Exception
     */
    public function set3pid($data)
    {
        if ($this->check()) {
            return $this->matrix()->request('POST', $this->endpoint('account/3pid'), $data, [
                    'access_token' => $this->data['access_token']
                ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Deactivate the user's account, removing all ability for the user to login again.
     *
     * @param  Array $data User Data
     * @return mixed|null        Empty json
     * @throws Exception
     */
    public function deactivate()
    {
        if ($this->check()) {
            return $this->matrix()->request('POST', $this->endpoint('account/deactivate'), [
                'auth' => [
                    'type' => 'm.login.password'
                ]
            ], [
                'access_token' => $this->data['access_token']
            ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Changes the password for an account on this homeserver.
     *
     * @param  String $password The new password
     * @return mixed|null             Empty json
     * @throws Exception
     */
    public function password($password)
    {
        if ($this->check()) {
            return $this->matrix()->request('POST', $this->endpoint('account/password'), [
                'auth' => [
                    'type' => 'm.login.password'
                ],
                'new_password' => $password
            ], [
                'access_token' => $this->data['access_token']
            ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Get the combined profile information for this user. This API may be used to fetch the user's own profile
     * information or other users; either locally or on remote homeservers.
     *
     * @param  String $userId User id in Matrix format
     * @return mixed|null           User data
     * @throws Exception
     */
    public function getProfile($userId = null)
    {
        if (!$userId) {
            if (!$this->check()) {
                throw new \Exception('Not authenticated');
            }
            $userId = $this->data['user_id'];
        }
        return $this->matrix()->request('GET', $this->endpoint('profile/'.$userId));
    }

    /**
     * Get the user's avatar URL. This API may be used to fetch the user's own avatar URL or to query the
     * URL of other users; either locally or on remote homeservers.
     *
     * @param  String $userId User id in Matrix format
     * @return mixed|null           Avatar Url
     * @throws Exception
     */
    public function getAvatar($userId = null)
    {
        if (!$userId) {
            if (!$this->check()) {
                throw new \Exception('Not authenticated');
            }
            $userId = $this->data['user_id'];
        }
        return $this->matrix()->request('GET', $this->endpoint('profile/'.$userId.'/avatar_url'));
    }

    /**
     * This API sets the given user's avatar URL. You must have permission to set this user's avatar URL,
     * e.g. you need to have their access_token.
     *
     * @param String $avatarUrl URL to the user image
     * @return mixed|null             Empty JSON
     * @throws Exception
     */
    public function setAvatar($avatarUrl)
    {
        if ($this->check()) {
            $userId = $this->data['user_id'];
            return $this->matrix()->request('PUT', $this->endpoint('profile/'.$userId.'/avatar_url'), [
                'avatar_url' => $avatarUrl
            ], [
                'access_token' => $this->data['access_token']
            ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Get the user's display name. This API may be used to fetch the user's own displayname or to query the
     * name of other users; either locally or on remote homeservers.
     *
     * @param  String $userId User id in Matrix format
     * @return mixed|null           User's display name
     * @throws Exception
     */
    public function getDisplayName($userId = null)
    {
        if (!$userId) {
            if (!$this->check()) {
                throw new \Exception('Not authenticated');
            }
            $userId = $this->data['user_id'];
        }
        return $this->matrix()->request('GET', $this->endpoint('profile/'.$userId.'/displayname'));
    }

    /**
     * This API sets the given user's display name. You must have permission to set this user's display name,
     * e.g. you need to have their access_token.
     *
     * @param String $displayName User's name
     * @return mixed|null         Empty Array
     * @throws Exception
     */
    public function setDisplayName($displayName)
    {
        if ($this->check()) {
            $userId = $this->data['user_id'];
            return $this->matrix()->request('PUT', $this->endpoint('profile/'.$userId.'/displayname'), [
                'displayname' => $displayName
            ], [
                'access_token' => $this->data['access_token']
            ]);
        }
        throw new \Exception('Not authenticated');
    }

    /**
     * Register user
     * @param  [type] $username [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function register($username, $password)
    {
        $data = $this->matrix()->request('POST', $this->endpoint('register'), [
            'auth' => [
                'type' => 'm.login.dummy'
            ],
            'bind_email' => true,
            'bind_msisdn' => true,
            'password' => $password,
            'username' => $username,
            'x_show_msisdn' => true
        ], [
            'kind' => 'user'
        ]);
        $this->setData($data);
        return $this->data;
    }

    //to do: set account data

    //to do: set user room account data

    //to do: get user room tags

    //to do: remove user room tags

    //to do: add user room tags
}
