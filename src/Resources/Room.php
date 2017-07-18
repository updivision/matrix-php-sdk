<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Resources\AbstractResource;

/**
 * Room management
 *
 * This provides methods to create and update rooms
 *
 * @package Matrix\Resources
 */
class Room extends AbstractResource
{
    /**
     * The resource endpoint
     *
     * @internal
     * @var string
     */
    protected $endpoint = '';

    public function createDirect($userId)
    {
        if ($this->check()) {
            return $this->matrix()->request('POST', $this->endpoint('createRoom'), [
                    'preset' => 'trusted_private_chat',
                    'visibility' => 'private',
                    'invite' => [$userId],
                    'is_direct' => true,
                    'initial_state' => [[
                        'content' => [
                            'guest_access' => 'can_join'
                        ],
                        'type' => 'm.room.guest_access',
                        'state_key' => ''
                    ]]
                ], [
                    'access_token' => $this->data['access_token']
                ]);
        }
        throw new \Exception('Not authenticated');
    }

    //{
    //  "preset":"trusted_private_chat",
    //  "visibility":"private",
    //  "invite":["@alyk:msg.pornfyre.com"],
    //  "is_direct":true,
    //  "initial_state":[
    //      {
    //       "content": {
    //              "guest_access":"can_join"
    //          },
    //       "type":"m.room.guest_access",
    //       "state_key":""
    //      }
    //   ]
    //}
}
