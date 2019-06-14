<?php

namespace FluffyFactory\Bundle\GdprBundle\Controller;

use FluffyFactory\Bundle\GdprBundle\Form\CookiesType;
use FluffyFactory\Bundle\GdprBundle\Service\CookieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

            return $this->redirectToRoute('homepage'); // TODO mettre route redirigée dans les params du bundle yaml, et par défaut rediriger ici
        }

        return $this->render('@Gdpr/privacy.html.twig', [
            'required_cookies' => $cookieService->getRequiredCookies(),
            'form' => $form->createView()
        ]);
    }

}
