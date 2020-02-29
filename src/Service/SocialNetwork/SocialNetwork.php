<?php

declare(strict_types = 1);

namespace Service\SocialNetwork;

class SocialNetwork
{
    /**
     * Получение класса соц.сети
     * @param string $socialNetwork
     * @param string $courseName
     * @return void
     */
    public function create(string $socialNetwork, string $courseName): void
    {
        switch ($socialNetwork) {
            case SocialNetworkInterface::SOCIAL_NETWORK_VK:
                $socialNetworkAdapter = new VKAdapter();
                break;
            case SocialNetworkInterface::SOCIAL_NETWORK_FACEBOOK:
                $socialNetworkAdapter = new FacebookAdapter();
                break;
            default:
                $socialNetworkAdapter = new VKAdapter();
        }

        $this->sendMessage($socialNetworkAdapter, $courseName);
    }

    /**
     * Отправка сообщения в соц.сеть
     * @param SocialNetworkInterface $socialNetwork
     * @param string $text
     * @return void
     */
    protected function sendMessage(SocialNetworkInterface $socialNetwork, string $text): void
    {
        $socialNetwork->send('pageId', $text, 'picturePath');
    }
}
