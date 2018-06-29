<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\SellerRequest;
use App\Form\SellerRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class SellerRequestController extends AbstractController
{
    public function index(): Response
    {
        $sellerRequest = new SellerRequest();
        $form = $this->createForm(SellerRequestType::class, $sellerRequest);

        return $this->render('sellerRequest.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
