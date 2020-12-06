<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GreenFormController extends AbstractController
{

    /**
     * @Route("/green", name="green_form")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request)
    {
        $defaultData = ['message' => 'Youhooo'];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            return $this->success($data);
        }

        return $this->render('green_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /*
     * @Route("/validated", name="form_success" )
     *
     * @return RedirectResponse|Response
     */
    public function success($data): Response
    {

        //TODO processing the data / Refactor Twig templates to have another entrypoint for form/tips assets
        $data = trim($data);
        return $this->render('green_form/index.html.twig', [

        ]);
    }
}
