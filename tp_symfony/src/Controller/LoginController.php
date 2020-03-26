<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Form\Extension\Core\Type;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'title' => "login"
                ));
    }

    private function createFormLogin()
    {
        return $this->createFormBuilder()
                ->add('mailAddress', Type\EmailType::class)
                ->add('password', Type\PasswordType::class)
                ->add('submit', Type\SubmitType::class)
                ->getForm();
    }
    
    private function fetchUser(string $mail, string $password)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $result = $repository->findOneBy(
            array(
                'mail' => $mail,
                'password' => $password
            )
        );
        return $result;
    }
    /**
     * @Route("/user", name="user")
     */
    public function showUser(Security $security){
        $user = $security->getUser();
        return $this->render('login/user.html.twig', array(
            'user' => $user,
            'title' => "login"
        ));
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        return $this->render(array(
            'welcome.html.twig',
            'title' => "deconnexion"
        ));
    }
}
