<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;
    public function __construct(Environment $twig)
    {
        $this->twig =$twig;
    }
    /**
     * @Route("/", name="home", options={"utf8": true})
     * 
     */
    public function index(PropertyRepository $repository):Response
    {

        $properties =$repository->FindLatest();
        return $this->render('pages/home.html.twig',[
            'properties' => $properties

        ]);

    }
}
