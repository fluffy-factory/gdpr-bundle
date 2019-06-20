<?php


namespace FluffyFactory\Bundle\GdprBundle\Twig;


use FluffyFactory\Bundle\GdprBundle\Service\CookieService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class cookieBarExtension extends AbstractExtension
{

    /**
     * @var CookieService
     */
    private $cookieService;
    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(CookieService $cookieService, ParameterBagInterface $params)
    {
        $this->cookieService = $cookieService;
        $this->params = $params;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('showCookieBar', [$this, 'showCookieBar']),
            new TwigFunction('getOptionnalCookiesNames', [$this, 'getOptionnalCookiesNames'], ['is_safe' => ['html']]),
            new TwigFunction('getDesign', [$this, 'getDesign']),
            new TwigFunction('allowedCookie', [$this, 'allowedCookie']),
        ];
    }

    public function showCookieBar(): bool
    {
        $cookies = array_keys($this->cookieService->getUserCookies());
        $optionnalCookies = array_keys($this->cookieService->getOptionnalCookies());

        foreach ($optionnalCookies as $cookieName) {
            if (!in_array($cookieName, $cookies)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getOptionnalCookiesNames(): string
    {
        return json_encode(array_keys($this->cookieService->getOptionnalCookies()));
    }

    /**
     * @param string $key
     * @return string
     */
    public function getDesign(string $key): string
    {
        return $this->params->get('fluffy.gdpr.design')[$key];
    }

    public function allowedCookie(string $cookieName)
    {
        return $this->cookieService->getUserCookie($cookieName) === "1";
    }
}
