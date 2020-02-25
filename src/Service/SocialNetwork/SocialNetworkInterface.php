<?php

declare(strict_types = 1);

namespace Service\SocialNetwork;

interface SocialNetworkInterface
{
    public const SOCIAL_NETWORK_VK = 'Vkontakte';
    public const SOCIAL_NETWORK_FACEBOOK = 'Facebook';

    /**
     * Отправка сообщения в соц.сеть
     *
     * @param string $pageId
     * @param string $text
     * @param string $picturePath
     *
     * @return void
     */
    public function send(string $pageId, string $text, string $picturePath): void;
}
