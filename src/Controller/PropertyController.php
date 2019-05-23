<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;

class PropertyController extends AbstractController
{
    private $repository;
    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/biens", name="property.index", options={"utf8": true})
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);
       $property = $paginator->paginate($this->repository->FindAllVisibleQuery($search),
                    $request->query->getInt('page', 1),
                    12);

        return $this->render('property/index.html.twig',[
            'propertys' => $property,
            'form' => $form->createView(),   
        ]);

    }

      /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-zA-Z1-9\-_\/]*"})
     * @param Property $property
     * @return Response
     */
    public function show(Property $property,string $slug):Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show',
            [
                'id' =>$property->id,
                'slug' =>$property->getSlug()
            ],301
        );
        }
        return $this->render('property/show.html.twig',[
            'property' => $property,

        ]);

    }
}
