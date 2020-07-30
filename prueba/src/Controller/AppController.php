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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType,ChoiceType};


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
        return $this->render('app/index.html.twig');
    }

    /*
     * Muestra un listado de usuarios siempre y cuando se haya logado.
     * La ruta esta en routes.yaml
     * @return Render view
     */
    public function listadoAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 50);

        return $this->render('app/listado.html.twig', [
                    'users' => $users
                ]);

    }
  
    /*
     * Muestra un formulario con los datos del usuario a editar siempre y cuando se haya logado.
     * La ruta esta en routes.yaml
     * @param Request $request, $id Id de usuario.
     * @return Render view     
     */
    public function editarAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userEdit = $this->getDoctrine()->getRepository(User::class)->find($id);
        $mensaje = '';
        $form = $this->createFormBuilder($userEdit)
            ->add('username', TextType::class)
            ->add('usernamecanonical', TextType::class)
            ->add('email', TextType::class)
            ->add('emailcanonical', TextType::class)
            ->add('enabled', ChoiceType::class, [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('save', SubmitType::class, array('label' => 'Editar Usuario'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $m = $this->getDoctrine()->getManager();

            $data = $form->getData();
            $userEdit = $data;
            $m->persist($userEdit);
            $m->flush();
            $mensaje = 'Usuario editado corréctamente';
        }


        return $this->render('app/editar.html.twig', array(
            'form' => $form->createView(), 'mensaje' => $mensaje
        ));


    }

    /*
     * Eliminar un usuario siempre y cuando se haya logado.
     * La ruta esta en routes.yaml
     * @param Request $request, $id Id de usuario.
     * @return Render view     
     */
    public function borrarAction($id, Request $request)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userDelete = $this->getDoctrine()->getRepository(User::class)->find($id);
        $m = $this->getDoctrine()->getManager();
        $m->remove($userDelete);
        $m->flush();
        
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers(0, 50);

        return $this->render('app/listado.html.twig', [
                    'users' => $users
                ]);

    }

}