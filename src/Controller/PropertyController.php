<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;

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
    public function index():Response
    {
       $property = $this->repository->FindAllVisible();

        return $this->render('property/index.html.twig');

    }

      /**
     * @Route("/biens/{slug}-{id}", name="property.show", options={"utf8": true})
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
