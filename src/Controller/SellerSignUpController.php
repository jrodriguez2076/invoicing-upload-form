<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\PrmAdapter;
use App\Entity\SellerSignUp;
use App\Form\SellerSignUpFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerSignUpController extends AbstractController
{
    /**
     * @var PrmAdapter
     */
    protected $prmAdapter;

    public function __construct(PrmAdapter $prmAdapter)
    {
        $this->prmAdapter = $prmAdapter;
    }

    public function index(Request $request, string $store): Response
    {
        $sellerSignUp = new SellerSignUp();

        $form = $this->createForm(
            SellerSignUpFactory::fromStore($store),
            $sellerSignUp
        );

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
