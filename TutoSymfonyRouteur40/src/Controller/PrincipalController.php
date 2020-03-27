<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * /** @Route("/gestemp/", name="gestemp_")
 */
class PrincipalController extends Controller
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index()
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    
    /**
     * @Route(
     *      "employe/{id}",
     *       name="voir",
     *       defaults={"id":99},
     *       requirements={"id":"\d+|[A-Za-z]+"}
     *          )
     */
    public function voirEmploye($id)
    {
        return $this->render('employe/voirEmploye.html.twig', array(
            'id' => $id
        ));
    }
    
    /**
     * @Route(
     *      "employeV2/{id}",
     *       name="voirV2")
     * @Template("employe/voirEmploye.html.twig")
     */
    public function voirEmployeV2($id)
    {
        return array(
            'id' => $id
        );
    }
    
    /**
     * @Route(
     *      "employeV3/{id}",
     *       name="voirV3")
     * @Template("employe/voirEmploye.html.twig")
     */
    public function voirEmployeV3($id)
    {
        return array(
            'id' => $id
        );
    }
    
    /**
     * @Route(
     *      "employe/{nom}",
     *       name="employe_redirection",
     *       requirements={"nom":"[A-Za-z]+"}
     *          )
     */
    public function redirectAction($nom)
    {
        $url = $this->generateUrl("gestemp_employe_voirnomB", array('nom' => 'Bond'));
        return $this->redirect($url);
    }
}
