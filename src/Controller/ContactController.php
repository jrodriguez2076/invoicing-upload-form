<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Contact;
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
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(PrmService $prmService, LoggerInterface $logger)
    {
        $this->prmService = $prmService;
        $this->logger = $logger;
    }

    public function index(Request $request, string $store): Response
    {
        $store = strtolower($store);

        $contact = new Contact();
        $form = $this->createForm(
            ContactFormFactory::fromStore($store),
            $contact
        );

        return $this->render(
            FormTemplateFactory::fromStore($store),
            [
                'form' => $form->createView(),
            ]
        );
    }

    public function healthCheckAction(): Response
    {
        return new Response('OK!');
    }
}
