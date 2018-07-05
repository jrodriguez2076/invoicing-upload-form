<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
use App\Entity\SellerRequest;
use App\Form\SellerRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerRequestController extends AbstractController
{
    /**
     * @var PrmAdapter
     */
    protected $prmAdapter;

    /**
     * @var string
     */
    protected $country;

    public function __construct(PrmAdapter $prmAdapter, string $country)
    {
        $this->prmAdapter = $prmAdapter;
        $this->country = $country;
    }

    public function index(Request $request): Response
    {
        $sellerRequest = new SellerRequest();

        $form = $this->createForm(
            SellerRequestType::class,
            $sellerRequest,
            ['country' => $this->country
        ]);

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
