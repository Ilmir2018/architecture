<?php

declare(strict_types = 1);

namespace Service\SocialNetwork;

class VKAdapter implements SocialNetworkInterface
{
    /**
     * @inheritdoc
     */
    public function send(string $pageId, string $text, string $picturePath): void
    {
        $group_id     = 'ID_ПРИЛОЖЕНИЯ';
        $access_token = 'ACCESS_TOKEN';

        // Получение сервера vk для загрузки изображения.
        $res = json_decode(file_get_contents(
            'https://api.vk.com/method/photos.getWallUploadServer?group_id='
            . $group_id . '&access_token=' . $access_token
        ));

        if (!empty($res->response->upload_url)) {
            // Отправка изображения на сервер.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $res->response->upload_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' => '@' . $picturePath));

            $res = json_decode(curl_exec($ch));
            curl_close($ch);

            if (!empty($res->server)) {
                // Сохранение фото в группе.
                $res = json_decode(file_get_contents(
                    'https://api.vk.com/method/photos.saveWallPhoto?group_id=' . $group_id
                    . '&server=' . $res->server . '&photo='
                    . stripslashes($res->photo) . '&hash='
                    . $res->hash . '&access_token=' . $access_token
                ));

                if (!empty($res->response[0]->id)) {
                    // Отправляем сообщение.
                    $params = array(
                        'access_token' => $access_token,
                        'owner_id'     => '-' . $group_id,
                        'from_group'   => '1',
                        'message'      => $text,
                        'attachments'  => $res->response[0]->id
                    );

                    file_get_contents(
                        'https://api.vk.com/method/wall.post?' . http_build_query($params)
                    );
                }
            }
        }
    }
}