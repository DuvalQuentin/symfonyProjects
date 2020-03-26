<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of FormulaireController
 *
 * @author 33618
 */
class FormulaireController extends AbstractController
{

    /**
     * @Route("/exempleformulaire", name="exempleformulaire")
     */
    public function exempleFormulaire(Request $request, Registry $doctrine)
    {
        $employe = new Employe();
        $form = $this->createFormBuilder($employe)
            ->add('nom', TextType::class)
            ->add('salaire', NumberType::class)
            ->add('enregistrer', SubmitType::class, array('label' => 'Créer'))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $employe = $form->getData();
            $e = $doctrine->getManager();
            $e->persist($employe);
            $e->flush();
            return $this->redirectToRoute('employe_ok', array("nom" => $employe->getNom()));
        }
        return $this->render('formulaires/exempleemploye.html.twig', array(
                'form' => $form->createView(),
        ));
    }
}
