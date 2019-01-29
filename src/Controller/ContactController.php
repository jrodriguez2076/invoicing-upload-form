<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
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
        $reasons = $this->prmAdapter->getReasons($store);

        $contact = new Contact();
        $form = $this->createForm(
            ContactFormFactory::fromStore($store, $reasons),
            $contact,
            ['reasons' => $reasons]
        );

        return $this->render(
            FormTemplateFactory::fromStore($store),
            [
                'form' => $form->createView(),
                'reasons' => $reasons,
            ]
        );
    }

    public function healthCheckAction(): Response
    {
        return new Response('OK!');
    }
}
