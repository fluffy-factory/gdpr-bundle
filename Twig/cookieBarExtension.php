<?php


namespace FluffyFactory\Bundle\GdprBundle\Twig;


use FluffyFactory\Bundle\GdprBundle\Service\CookieService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class cookieBarExtension extends AbstractExtension
{

    /**
     * @var CookieService
     */
    private $cookieService;

    public function __construct(CookieService $cookieService)
    {
        $this->cookieService = $cookieService;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('showCookieBar', [$this, 'showCookieBar']),
        ];
    }

    public function showCookieBar(): bool
    {
        $cookies = array_keys($this->cookieService->getCurrentCookies());
        $optionnalCookies = array_keys($this->cookieService->getOptionnalCookies());

        foreach ($optionnalCookies as $cookieName) {
            if (!in_array($cookieName, $cookies)) {
                return true;
            }
        }

        return false;
    }
}
