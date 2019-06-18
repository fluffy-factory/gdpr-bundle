<?php

namespace FluffyFactory\Bundle\GdprBundle\Form;

use FluffyFactory\Bundle\GdprBundle\Service\CookieService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints\NotNull;

class CookiesType extends AbstractType
{

    /**
     * @var CookieService
     */
    private $cookieService;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(CookieService $cookieService, RequestStack $requestStack)
    {
        $this->cookieService = $cookieService;
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cookies = $this->cookieService->getOptionnalCookies();
        $request = $this->requestStack->getCurrentRequest();

        foreach ($cookies as $k => $cookie) {
            $cookieData = $request->cookies->get($k);

            $builder->add($k, ChoiceType::class, [
                'required' => true,
                'expanded' => true,
                'data' => $cookieData,
                'constraints' => [new NotNull()],
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ]
            ]);
        }
    }

}
