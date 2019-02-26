<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
use App\Form\ContactFormFactory;
use App\Form\FormTemplateFactory;
use App\Service\PrmService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @var PrmService
     */
    protected $prmService;

    /**
     * @var PrmAdapter
     */
    protected $prmAdapter;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(PrmService $prmService, LoggerInterface $logger, PrmAdapter $prmAdapter)
    {
        $this->prmService = $prmService;
        $this->logger = $logger;
        $this->prmAdapter = $prmAdapter;
    }

    public function index(Request $request, string $store): Response
    {
        $store = strtolower($store);
        $reasonsInformation = $this->prmAdapter->getReasons($store);

        $form = $this->createForm(
            ContactFormFactory::fromStore($store),
            null,
            [
                'reasons' => $reasonsInformation['reasons'],
                'store' => $store,
                'reasonsEnabledFields' => $reasonsInformation['reasonsEnabledFields'],
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('success.html.twig');
        }

        return $this->render(
            FormTemplateFactory::fromStore($store),
            [
                'form' => $form->createView(),
                'reasons' => $reasonsInformation['reasons'],
                'reasonsEnabledFields' => $reasonsInformation['reasonsEnabledFields'],
            ]
        );
    }

    public function healthCheckAction(): Response
    {
        return new Response('OK!');
    }
}
