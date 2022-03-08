<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\Session\Session;
class UserController extends AbstractController
{
    /**
     * @Route("/user/listo", name="listo")
     */
    public function listo(UserRepository $repository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('admin/mypdf.html.twig', [
            'users' => $repository->findAll()
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');

    }
    /**
     * @Route("/user/add", name="nouveau")
     */
    public function addUser(Request $request ,\Swift_Mailer $mailer):Response
    {
        $User = new User();
        $form=$this->createForm(UserType::class,$User);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $User=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();
            $message = (new \Swift_Message('Hello User'))
                ->setFrom('utravel.esprit@gmail.com')
                ->setTo($User->getEmail())
                ->setBody($this->renderView('/user/registration.html.twig', compact('User')), 'text/html');
            $mailer->send($message);

            return $this->redirectToRoute('login');
        }
        return $this->render('/user/add.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("user/login", name="login")
     */
    public function login(Request $request) : Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $notTrueUser = $form->getData();
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy($notTrueUser->getPassword(),$notTrueUser->getEmail());
            if (!$user) {
                throw $this->createNotFoundException(
                    'No product found for this email and password '
                );
            }
            $session = new Session();
            $session->set('user', $user);
            return $this->redirectToRoute('user');
        }
        return $this->render('user/login.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("user/login2", name="login2")
     */
    public function login2(Request $request) : Response
    {


        $data = $request->request->all();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['email' => $data['_username'], 'password' => $data['_password']]);
        if (!$user) {
            throw $this->createNotFoundException(
                'No User found for this email and password '
            );
        }
        $session = new Session();
        $session->set('user', $user);

        return $this->redirectToRoute('user');


    }
    /**
     * @Route ("user/Userlist", name="list")
     */
    public function list(UserRepository $repository): Response
    {
        //$repo=$this->getDoctrine()->getRepository(User::class);
        $User=$repository->findAll();
        return $this->render('User/Userlist.html.twig',['User'=>$User]);
    }

    /**
     * @Route("user/update/{id}", name="update")
     */
    public function updates(Request $request, $id): Response
    {
        $rep = $this->getDoctrine()->getRepository(User::class);
        $User = $rep->find($id); // nouvelle instance
        $form = $this->createForm(UserType::class, $User);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('list');
        }


        return $this->render('user/update.html.twig', [
            'formA' => $form->createView(),
        ]);
    }

    /**
     * @Route("user/delete/{id}", name="deletes")
     */
    public function deletes($id): Response
    { $rep=$this->getDoctrine()->getRepository(User::class);
        $em=$this->getDoctrine()->getManager();
        $User=$rep->find($id);
        $em->remove($User);
        $em->flush();

        return $this->redirectToRoute('list');

    }



}
