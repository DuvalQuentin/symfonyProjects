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
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmployeType;


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
    public function exempleFormulaire(Request $request, ManagerRegistry $doctrine)
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
    
    /**
     * @Route("/employe_ok/{nom}", name="employe_ok")
     */
    public function employeOk(string $nom)
    {
        return $this->render('formulaires/employeok.html.twig', array(
            "nom" => $nom
        ));
    }
    
    /**
     * @Route("/employe_message_ok/{nom}/{message}", name="employe_message_ok")
     */
    public function employeMessageOk(string $nom, string $message)
    {
        return $this->render('formulaires/employemessageok.html.twig', array(
            "nom" => $nom,
            "message" => $message
        ));
    }
    
    /**
     * @Route("/testform")
     */
    public function testForm(Request $request, ManagerRegistry $doctrine)
    {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $employe = $form->getData();
            $e = $doctrine->getManager();
            $e->persist($employe);
            $e->flush();
            $message = "En attente d'agrément";
            if($form->get('agreer')->getData()){
                $message="Il à agréé";
            }
            return $this->redirectToRoute('employe_message_ok', array("nom" => $employe->getNom(),
                                                              "message"=>$message));
        }
        return $this->render('formulaires/exempleemploye.html.twig', array(
            "form" => $form->createView()
        ));
    }
    
    /**
     * @Route("/sousform")
     */
    public function sousForm(Request $request)
    {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $employe = $form->getData();
            $message = "En attente d'agrément";
            if($form->get('agreer')->getData()){
                $message="Il a agréé";
            }
            return $this->redirectToRoute('employe_message_ok', array("nom" => $employe->getNom(),
                                                              "message"=>$message));
        }
        return $this->render('formulaires/exempleemployeprojet.html.twig', array(
            "form" => $form->createView()
        ));
    }
}
