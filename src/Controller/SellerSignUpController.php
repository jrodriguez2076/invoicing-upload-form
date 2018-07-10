<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
use App\Entity\SellerSignUp;
use App\Form\SellerSignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerSignUpController extends AbstractController
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
        $sellerSignUp = new SellerSignUp();

        $form = $this->createForm(
            SellerSignUpType::class,
            $sellerSignUp,
            ['country' => $this->country
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->prmAdapter->createAccount($sellerSignUp);
        }

        return $this->render(
            'sellerSignUp.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
