<?php

namespace FluffyFactory\Bundle\GdprBundle\Service;

use FluffyFactory\Bundle\GdprBundle\Model\Cookie;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CookieService
{
    /**
     * @var array
     */
    private $cookies;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(array $cookies, RequestStack $requestStack, ParameterBagInterface $params)
    {
        $this->cookies = $this->parseCookies($cookies);
        $this->requestStack = $requestStack;
        $this->params = $params;
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
     * @return array
     */
    public function getUserCookies()
    {
        return $this->requestStack->getCurrentRequest()->cookies->all();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getUserCookie(string $name)
    {
        return $this->requestStack->getCurrentRequest()->cookies->get($name);
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

    /**
     * @return string
     */
    public function getRedirectionUrl(): string
    {
        return $this->params->get('fluffy.gdpr.redirection_url');
    }
}
