<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

/** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;
use App\Entity\Admin;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\AdminType;
use Symfony\Component\HttpFoundation\Session\Session;
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
    * @Route("/admin/dashboard", name="dashboard")
    */
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/ajout", name="ajout")
     */
    public function addAdmin(Request $request):Response
    {
        $admin = new admin();
        $form=$this->createForm(AdminType::class,$admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('connexion');
        }
        return $this->render('admin/ajout.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/ajout2", name="ajout2")
     */
    public function addAdmin2(Request $request):Response
    {
        $admin = new admin();
        $form=$this->createForm(AdminType::class,$admin);
        $form->handleRequest($request);

        $admin=$form->getData();
        $em=$this->getDoctrine()->getManager();
        $em->persist($admin);
        $em->flush();
        return $this->redirectToRoute('connexion');


    }
    /**
     * @Route("admin/seconnecter", name="connexion")
     */
    public function login2(Request $request) : Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        return $this->render('admin/seconnecter.html.twig', array(
            'form' => $form->createView(),
        ));
        return $this->redirectToRoute('dashboard');
    }
    /**
     * @Route("admin/seconnecter2", name="connexion2")
     */
    public function login(Request $request) : Response
    {
        $data = $request->request->all();

        $admin = $this->getDoctrine()

            ->getRepository(Admin::class)
            ->findOneBy(['email' => $data['_username'], 'password' => $data['_password']]);
        if (!$admin) {
            throw $this->createNotFoundException(
                'No User found for this email and password '
            );
        }
        $session = new Session();
        $session->set('admin', $admin);

        return $this->redirectToRoute('dashboard');

    }
    /**
     * @Route ("admin/list", name="List")
     */
    public function list(AdminRepository $repository): Response
    {
        $admin=$repository->findAll();
        return $this->render('admin/list.html.twig',['admin'=>$admin]);
    }

    /**
     * @Route("admin/modifier/{id}", name="modifier")
     */
    private function updates(Request $request, $id): Response
    {
        $rep = $this->getDoctrine()->getRepository(admin::class);
        $admin = $rep->find($id); // nouvelle instance
        $form = $this->createForm(adminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('List');
        }
        return $this->render('admin/modifier.html.twig', [
            'formA' => $form->createView(),
        ]);
    }
    /**
     * @Route("admin/supprimer/{id}", name="supprimer")
     */
    protected function delete($id): Response
    {
        $rep=$this->getDoctrine()->getRepository(Admin::class);
        $em=$this->getDoctrine()->getManager();
        $admin=$rep->find($id);
        $em->remove($admin);
        $em->flush();

        return $this->redirectToRoute('List');

    }
    /**
     * @Route("admin/Userlist", name="Users")
     */
    public function Userlist():Response
    {
        $response = $this->forward('App\Controller\UserController::list',[]);
        return $response;
    }
    /**
     * @Route("admin/pdf", name="pdf")
     */
    public function pdf():Response
    {
        $response = $this->forward('App\Controller\UserController::list',[]);
        return $response;
    }


}
