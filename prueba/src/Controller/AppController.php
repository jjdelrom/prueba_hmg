<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\ExpressionLanguage\Expression;

use App\Entity\User;
use App\Repository\UserRepository;


class AppController extends AbstractController
{

    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

    /*
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // if(isset($_SESSION)){
        //     $session = $_SESSION;
        //     echo '<pre>'; print_r($session); echo '</pre>';            
        // }

        // $session = $request->getSession();
        // echo '<pre>'; print_r($session); echo '</pre>';

 // getUser() isGranted($attributes, $subject = null): bool getToken(): ?TokenInterface   IS_AUTHENTICATED_FULLY
// $this->token_storage->getToken()->getUser();
// echo '<pre>'; print_r($this->token_storage->getToken()->getUser()); echo '</pre>';
       // if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
       //      throw new AccessDeniedException();
       //  }
        // 
        
        // $authErrorKey = Security::AUTHENTICATION_ERROR;
        // $lastUsernameKey = Security::LAST_USERNAME;

        // if(isGranted('IS_AUTHENTICATED_FULLY')){
        //     echo '<pre>'; print_r(Security::getUser()); echo '</pre>';
        // }
        
// echo '<pre>'; print_r($this->denyAccessUnlessGranted('ROLE_ADMIN')); echo '</pre>';        

$csrfToken = $this->tokenManager ? $this->tokenManager->getToken('authenticate')->getValue() : null;

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 10);
       
        $loginPath = $this->generateUrl('auth_login_check');

        return $this->render('app/index.html.twig');
    }


    public function listadoAction(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // $user = $this->getUser();
        // $access = $authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY');

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 50);

        return $this->render('app/listado.html.twig', [
                    'users' => $users
                ]);

    }
     
    public function editarAction($id, Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$access1 = $authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY');
        // $access2 = $authorizationChecker->isGranted(new Expression(
        //     'is_remember_me() or is_fully_authenticated()'
        // ));
        // 
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 50);
        
        $userEdit = $this->getDoctrine()->getRepository(User::class)->find($id);

        $user = $this->getUser();

        return $this->render('app/listado.html.twig', [
                    'users' => $users
                ]);

    }

    public function borrarAction(/*UserInterface $user,*/ $id, Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // $userManager = $container->get('fos_user.user_manager');

        // $user = $userManager->createUser();
        // $user->setUsername('John');
        // $user->setEmail('john.doe@example.com');

        // $userManager->updateUser($user);

        $userDelete = $this->getDoctrine()->getRepository(User::class)->find($id);
        $m = $this->getDoctrine()->getManager();
        $m->remove($userDelete);
        $m->flush();
                    $this->addFlash('success', 'Registro eliminado correctamente' );

    
        // $this->objectManager->remove($user);
        // $this->objectManager->flush();
    

        echo $id;
        die("SSSSSSS");
        

        $user = $this->getUser();
         // echo '<pre>'; print_r($user); echo '</pre>';
// die();

        $access1 = $authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY');
    // echo "string ".$access1;

    // $access2 = $authorizationChecker->isGranted(new Expression(
    //     'is_remember_me() or is_fully_authenticated()'
    // ));

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 50);

        return $this->render('app/listado.html.twig', [
                    'users' => $users
                ]);

    }

}