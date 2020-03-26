<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Employe;
use App\Entity\Lieu;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index()
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => "symfony c'est super",
        ]);
    }
    
    
    /**
     * @Route("/welcome/{nom}")
     */
    public function welcome($nom)
    {
        return $this->render('principal/welcome.html.twig', array(
            "nom" => $nom
        ));
    }
    
    /**
     * @Route("/zionInfo/{nom}/{particularite}")
     */
    public function zionInfo($nom, $particularite)
    {
        return $this->render('principal/zion.html.twig', array(
            "nom" => $nom,
            "particularité" => $particularite
        ));
    }
    
    /**
     * @Route("/employes", name="employes")
     * @param ManagerRegistry $doctrine
     */
    public function afficheEmployes(ManagerRegistry $doctrine)
    {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
    /**
     * @Route("/employe/{id}", name="unemploye", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmploye(ManagerRegistry $doctrine, int $id)
    {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unemploye.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/employetout/{id}", name="employetout", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmployeTout(ManagerRegistry $doctrine, int $id)
    {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/employetout.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/lieu/{idLieu}", name="lieu")
     * @param ManagerRegistry $doctrine
     */
    public function afficheLieu(ManagerRegistry $doctrine, int $idLieu)
    {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Lieu + employés";
        $lieu = $doctrine->getRepository(Lieu::class)->find($idLieu);
        return $this->render('principal/lieu.html.twig', compact('titre', 'employes', 'lieu'));
    }
}
