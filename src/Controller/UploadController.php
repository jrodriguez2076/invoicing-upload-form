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
        $contacts = $this->oroAdapter->getContacts();
        $contactValues = [];
        foreach ($contacts as $key => $contactEmail) {
            $contactValues[] = $contactEmail;
        }

        $form = $this->createForm(
            UploadType::class,
            null,
            [
                'categories' => $categories,
                'contacts' => $contacts,
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $contactId = $this->oroAdapter->getContactIdByEmail($form->getData()['contactEmail']);
                $this->oroAdapter->sendFiles($form->getData(), $contactId);
            } catch (OroException $exception) {
                $this->addFlash('error', $exception->getMessage());

                return $this->render(
                    'upload.html.twig',
                    [
                        'form' => $form->createView(),
                        'contacts' => $contactValues,
                    ]
                );
            }

            return $this->render('success.html.twig');
        }

        return $this->render(
            'upload.html.twig',
            [
                'form' => $form->createView(),
                'contacts' => $contactValues,
            ]
        );
    }

    public function healthCheckAction(): Response
    {
        return new Response('OK!');
    }
}
