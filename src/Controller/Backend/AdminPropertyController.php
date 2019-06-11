<?php
namespace App\Controller\Backend;
use Twig\Environment;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repositories;

    public function __construct(PropertyRepository $repositories,ObjectManager $em)
    {
        $this->repositories = $repositories;
        $this->em = $em;
    }

     /**
     * @Route("/admin", name="admin.property.index", options={"utf8": true})
     * @return \Symfony\Component\HttpFoundation\Response;
     * 
     */
    public function index()
    {
        $properties =  $this->repositories->findAll();

        return $this->render('admin/property/index.html.twig',compact('properties'));
    }

  /**
     * @Route("/admin/property/new", name="admin.property.create")
     * @return \Symfony\Component\HttpFoundation\Response;
     * 
     */
    public function new(Request $request)
    {
        $property =  new Property();
        $form =  $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            // var_dump($form['imageFile']->getData());
            var_dump($request->files);
            exit();
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Bien crée  avec succee');

 
            return $this->redirectToRoute('admin.property.index');
        }
         return $this->render('admin/property/create.html.twig',[
                 'property' => $property,
                 'form' => $form->createView()
 
 
         ]);


    }
     /**
     * @Route("/admin/{id}", name="adminpropertyedit")
     * @return \Symfony\Component\HttpFoundation\Response;
     * 
     */
    public function edit(Property $property,Request $request)
    {
       $form =  $this->createForm(PropertyType::class,$property);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {

        // if($property->getImageFile() instanceof UploadedFile)
        // {
        //     $cacheManager->remove($helper->asset($property,'imageFile'));

        // }
           $this->em->flush();
           $this->addFlash('success','Bien modifié avec succee');

           return $this->redirectToRoute('admin.property.index');
       }
        return $this->render('admin/property/edit.html.twig',[
                'property' => $property,
                'form' => $form->createView()


        ]);
    }



   /**
     * @Route("/admin/{id}", name="admin.property.delete" ,methods ="DELETE")
     * @return \Symfony\Component\HttpFoundation\Response;
     * 
     */

    public function delete(Property $property ,Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $property->getId(),$request->get('_token')))
        {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success','Bien supprimé  avec succee');


        }
        return $this->redirectToRoute('admin.property.index');
    }



}