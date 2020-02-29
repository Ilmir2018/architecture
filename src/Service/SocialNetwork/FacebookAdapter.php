<?php

declare(strict_types = 1);

namespace Service\SocialNetwork;

use Facebook\Facebook;

class FacebookAdapter implements SocialNetworkInterface
{
    /**
     * @inheritdoc
     */
    public function send(string $pageId, string $text, string $picturePath): void
    {
        $facebook = new Facebook([
            'app_id' => '{app-id}',
            'app_secret' => '{app-secret}',
            'default_graph_version' => 'v2.10',
            'default_access_token' => '{access-token}', // optional
        ]);

        $data = [
            'message' => $text,
            'source' => $facebook->fileToUpload($picturePath),
        ];

        $responses = $facebook->sendBatchRequest([
            'photo' => $facebook->request('POST', "/" . $pageId . "/photos", $data),
        ]);
    }
}