<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use App\Repository\ProductoRepository;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class PrincipalController extends AbstractController
{

    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/", name="index")
     */

    public function index(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $passwordEncoder, ProductoRepository $productoRepository, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator)
    {

            $user = new User();
            $form = $this->createForm(RegistrationFormType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // generate a signed url and email it to the user
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('2daajpautor20@ieslasfuentezuelas.com', 'adminjl'))
                        ->to($user->getCorreo())
                        ->subject('Por favor, confirme su correo')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );
                // do anything else you need here, like send an email

                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main' // firewall name in security.yaml
                );
            }

        //FORMULARIO DE LOGIN

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('anonimo.html.twig', [
                'titulo' => 'Tallas de madera',
                'productos' => $productoRepository->findAll(),      //Para mostrar las tallas en la tienda
                'registrationForm' => $form->createView(),          //Para el formulario de registro
                'last_username' => $lastUsername,                   //Para el formulario de login
                'error' => $error                                   //Para el formulario de login
            ]);
    }

    /**
     * @Route("/logueado", name="logueado")
     */

    public function login(AuthenticationUtils $authenticationUtils, ProductoRepository $productoRepository): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('logueado.html.twig', [
            'titulo' => 'Tallas de Madera',
            'productos' => $productoRepository->findAll(),
            'last_username' => $lastUsername, 
            'error' => $error
        ]);

    }

    /**
     * @Route("/admin", name="admin", methods="GET")
     */

    public function admin(UserRepository $userRepository, ProductoRepository $productoRepository)
    {

        return $this->render('admin.html.twig', [
            'titulo'=>'Administrador',
            'users' => $userRepository->findAll(),
            'productos' => $productoRepository->findAll()
        ]);
    
    }
}
