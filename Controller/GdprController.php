<?php

namespace FluffyFactory\Bundle\GdprBundle\Controller;

use FluffyFactory\Bundle\GdprBundle\Form\CookiesType;
use FluffyFactory\Bundle\GdprBundle\Service\CookieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GdprController extends AbstractController
{

    /**
     * @Route("/privacy-policy", name="fluffy_gdpr")
     */
    public function privacyPolicy(Request $request, CookieService $cookieService): Response
    {
        $form = $this->createForm(CookiesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $response = new RedirectResponse($this->generateUrl($cookieService->getRedirectionUrl()));

            foreach ($data as $k => $value) {
                $expireDate = new \DateTime();
                $expireDate->modify('1 year');
                $cookie = new Cookie($k, $value ? 1 : 0, $expireDate);
                $response->headers->setCookie($cookie);
            }

            return $response;
        }

        return $this->render('@Gdpr/privacy.html.twig', [
            'required_cookies' => $cookieService->getRequiredCookies(),
            'form' => $form->createView()
        ]);
    }

}
