<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Prm;
use App\Entity\SellerRequest;
use App\Form\SellerRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerRequestController extends AbstractController
{
    /**
     * @var Prm
     */
    protected $prmAdapter;

    public function __construct(Prm $prmAdapter)
    {
        $this->prmAdapter = $prmAdapter;
    }

    public function index(Request $request): Response
    {
        $sellerRequest = new SellerRequest();
        $form = $this->createForm(SellerRequestType::class, $sellerRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->prmAdapter->createAccount($sellerRequest);
        }

        return $this->render(
            'sellerRequest.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
