<?php

namespace Updivision\Matrix\Resources;

use Updivision\Matrix\Resources\AbstractResource;

/**
 * Media management
 *
 * This provides methods to create and update media
 *
 * @package Matrix\Resources
 */
class Media extends AbstractResource
{
    /**
     * The resource endpoint
     *
     * @internal
     * @var string
     */
    protected $endpoint = '';

    public function upload($file, $contentType)
    {
        if ($this->check()) {
            $data = file_get_contents($file);
            return $this->matrix()->request('POST', $this->endpoint('upload'), [
                    'body' => $data,
                    'headers'  => [
                        'Content-Type' => $contentType,
                        'Content-Length' => strlen($data)
                    ]
                ], [
                    'filename' => basename($file),
                    'access_token' => $this->data['access_token']
                ], true);
        }
        throw new \Exception('Not authenticated');
    }
}
