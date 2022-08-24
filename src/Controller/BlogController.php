<?php

namespace App\Controller;

use App\Service\Greeting;
use App\Service\VeryBadDesign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private $greeting , $badDesign;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(Greeting $greeting , VeryBadDesign $badDesign  ,
    Environment $twig , SessionInterface $session, RouterInterface $router)
    {
        $this->greeting = $greeting;
        $this->badDesign = $badDesign;
        $this->twig = $twig;
        $this->session = $session;
        $this->router = $router;
    }

//    public function index(): Response
//    {
//        return $this->render('blog/index.html.twig', [
//            'controller_name' => 'BlogController',
//        ]);
//    }

//    #[Route('/blog', name: 'blog')]
//    #[Route('/{name}', name: 'blog')]

/**
 * @Route("/",name="blog_index")
*/
//    public function index(Request $request )
//    public function index($name )
    public function index()
    {
//        return $this->get('app.greeting'); doeesn't work in abstractcontroller
        $html = $this->twig->render('blog/index.html.twig', [
//            'message' => $this->greeting->greet($name),
//            'message' => $this->greeting->greet($request->get('name')),

        'posts'=>$this->session->get('posts')
        ]);
        return new Response($html);

//        return $this->render('blog/index.html.twig', [
//            'message' => $this->greeting->greet($request->get('name')),
//        ]);
    }

    /**
    * @Route("/add",name="blog_add")
     */
    public function add()
    {
        $posts = $this->session->get('posts');

        $posts[uniqid()] = [
            'title' => ' A Random title ' . rand(1, 1000),
            'text' => 'Some random text nr ' . rand(1, 1000),
            'date'=> new \DateTime()
        ];

        $this->session->set('posts', $posts);

        return new RedirectResponse($this->router->generate('blog_index'));

    }
    /**
     * @Route("/show/{id}",name="blog_show")
     */
    public function show($id)
    {
        $posts = $this->session->get('posts');

        if (!$posts || !isset($posts[$id])) {
            throw new NotFoundHttpException('Post Not Found');
        }

        $html = $this->twig->render(
            'blog/post.html.twig',
            [
                'id' => $id,
                'post' => $posts[$id],

            ]
        );

        return new Response($html);
    }
}
