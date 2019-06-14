<?php

namespace FluffyFactory\Bundle\GdprBundle\Service;


use FluffyFactory\Bundle\GdprBundle\Model\Cookie;

class CookieService
{

    /**
     * @var array
     */
    private $cookies;

    public function __construct(array $cookies)
    {
        $this->cookies = $this->parseCookies($cookies);
    }

    private function parseCookies(array $cookies)
    {
        $res = [];
        foreach ($cookies['cookies'] as $k => $v) {
            $cookie = new Cookie($v['name'], $v['description'], $v['required']);

            if (!empty($v['detail'])) {
                $cookie->setDetail($v['detail']);
            }

            $res[$k] = $cookie;
        }

        return $res;
    }

    /**
     * @return Cookie[]
     */
    public function getCookies(): ?array
    {
        return $this->cookies;
    }

    /**
     * @return Cookie[]
     */
    private function filterCookies(bool $required): array
    {
        return array_filter($this->cookies, function(Cookie $e) use ($required) {
            return $e->isRequired() === $required;
        });
    }

    /**
     * @return Cookie[]
     */
    public function getRequiredCookies(): array
    {
        return $this->filterCookies(true);
    }

    /**
     * @return Cookie[]
     */
    public function getOptionnalCookies(): array
    {
        return $this->filterCookies(false);
    }

}