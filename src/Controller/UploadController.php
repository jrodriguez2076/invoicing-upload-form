<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\OroAdapter;
use App\Exception\OroException;
use App\Form\UploadType;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends AbstractController
{
    /**
     * @var OroAdapter
     */
    protected $oroAdapter;

    public function __construct(LoggerInterface $logger, OroAdapter $oroAdapter)
    {
        $this->oroAdapter = $oroAdapter;
    }

    public function index(Request $request): Response
    {
        $categories = $this->oroAdapter->getCategories();
        $accounts = $this->oroAdapter->getAccounts();

        $form = $this->createForm(
            UploadType::class,
            null,
            [
                'categories' => $categories,
                'accounts' => $accounts,
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->oroAdapter->sendFiles($form->getData(), $form->getData()['relatedAccount']);
            } catch (OroException $exception) {
                $this->addFlash('error', $exception->getMessage());

                return $this->render(
                    'upload.html.twig',
                    [
                        'form' => $form->createView(),
                        'accounts' => $accounts,
                    ]
                );
            }

            return $this->render('success.html.twig');
        }

        return $this->render(
            'upload.html.twig',
            [
                'form' => $form->createView(),
                'accounts' => $accounts,
            ]
        );
    }

    public function healthCheckAction(): Response
    {
        return new Response('OK!');
    }
}
