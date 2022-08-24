<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var MicroPostRepository
     */
    private $microPostRepository;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(Environment $twig
        ,MicroPostRepository $microPostRepository
        , FormFactoryInterface $formFactory
        , EntityManagerInterface $entityManager
        , RouterInterface $router, FlashBagInterface $flashBag )
    {

        $this->twig = $twig;
        $this->microPostRepository = $microPostRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->flashBag = $flashBag;
    }


    #[Route('/', name: 'micro_post_index')]
    public function index(): Response
    {
        $html= $this->twig->render('micro_post/index.html.twig', [
//            'posts' => $this->microPostRepository->findAll(),
            'posts' => $this->microPostRepository->findBy([],['time'=>'DESC']),
            'controller_name' => 'MicroPostController',
        ]);

        return new Response($html);
    }

    /**
    *@Route("/edit/{id}",name="micro_post_edit")
    */
    public function edit(MicroPost $microPost, Request $request)
    {
        $form = $this->formFactory->create(MicroPostType::class, $microPost);

        $form->handleRequest($request);

//        $microPost->setTime(new \DateTime('2021-03-18'));
        if ($form->isSubmitted() && $form->isValid()) {
//            $this->entityManager->persist($microPost); // it's not needed
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('micro_post_index'));
        }

        return new Response(
            $this->twig->render('micro_post/add.html.twig',[
                'form'=>$form->createView()
            ])
        );
    }
    #[Route('/add', name: 'micro_post_add')]

    public function add(Request $request)
    {
        $microPost = new MicroPost();

        $microPost->setTime(new \DateTime());

        $form = $this->formFactory->create(MicroPostType::class, $microPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($microPost);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('micro_post_index'));
        }

        return new Response(
            $this->twig->render('micro_post/add.html.twig',[
                'form'=>$form->createView()
            ])
        );
    }

    /**
    *@Route("/delete/{id}",name="micro_post_delete")
    */
    public function delete(MicroPost $microPost)
    {
        $this->entityManager->remove($microPost);
        $this->entityManager->flush();

        $this->flashBag->add('notice', 'Micro post was deleted');
        return new RedirectResponse($this->router->generate('micro_post_index'));

    }
//    should be after add route
    /**
     *@Route("/{id}",name="micro_post_post")
     */
//    public function post($id)
    public function post(MicroPost $post)
    {
//        $post = $this->microPostRepository->find($id);

        return new Response(
            $this->twig->render('micro_post/post.html.twig',
                [
                    'post' => $post
                ]
            )
        );
    }


}
