<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
use App\Exception\PrmException;
use App\Form\ContactFormFactory;
use App\Form\FormTemplateFactory;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @var PrmAdapter
     */
    protected $prmAdapter;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger, PrmAdapter $prmAdapter)
    {
        $this->logger = $logger;
        $this->prmAdapter = $prmAdapter;
    }

    public function index(Request $request, string $store): Response
    {
        $store = strtolower($store);
        $accessToken = $this->prmAdapter->getAccessToken();
        $reasonsInformation = $this->prmAdapter->getReasons($accessToken, $store);
        $accountId = $this->prmAdapter->getGenericAccountId($accessToken, $store);

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
            try {
                $this->prmAdapter->createCase($accessToken, $form->getData(), $reasonsInformation['reasonsEnabledFields'], $store, $accountId);
            } catch (PrmException $exception) {
                $this->logger->error($exception->getMessage());
                $this->addFlash('error', 'GENERAL_ERROR');

                return $this->render(
                    FormTemplateFactory::fromStore($store),
                    [
                        'form' => $form->createView(),
                        'reasons' => $reasonsInformation['reasons'],
                        'reasonsEnabledFields' => $reasonsInformation['reasonsEnabledFields'],
                    ]
                );
            }

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
