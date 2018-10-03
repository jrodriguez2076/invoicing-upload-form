<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\SellerSignUp;
use App\Exception\PrmException;
use App\Form\FormTemplateFactory;
use App\Form\SellerSignUpFormFactory;
use App\Service\PrmService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerSignUpController extends AbstractController
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
        $slimForm = false;

        $hunter = $request->get('hunter', '');

        if ($hunter) {
            $slimForm = true;
        }

        $sellerSignUp = new SellerSignUp();
        $form = $this->createForm(
            SellerSignUpFormFactory::fromStore($store, $slimForm),
            $sellerSignUp
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->prmService->processFormData(
                    $sellerSignUp,
                    $store,
                    $hunter
                );
            } catch (PrmException $exception) {
                $this->logger->error($exception->getMessage());
                $this->addFlash('error', 'GENERAL_ERROR');

                return $this->render(
                    FormTemplateFactory::fromStore($store, $slimForm),
                    [
                        'form' => $form->createView(),
                        'hunter' => $hunter,
                    ]
                );
            }

            return $this->render('success.html.twig');
        }

        return $this->render(
            FormTemplateFactory::fromStore($store, $slimForm),
            [
                'form' => $form->createView(),
                'hunter' => $hunter,
            ]
        );
    }
}
