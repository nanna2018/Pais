<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Ciudad;
use App\Form\CiudadType;


/**
     * @Route("/ciudad")
     */
class CiudadController extends Controller
{ 

 /**
     * @Route("/lista", name="ciudad_lista")
     */
    public function listado()
    {

       $ciudad= $this->getDoctrine()->getRepository(Ciudad::class);
        $vector = $ciudad->findAll();
         dump($vector);

            return $this->render('ciudad/index.html.twig', [
            'ciudades'=> $vector,

        ]);
    
    }
    /**
     * @Route("/nuevo", name="ciudad_nuevo")
     */
    public function nuevo(Request $request)
    {
        
        $ciudad=new Ciudad();
        $formu=$this->createForm(CiudadType::class,$ciudad);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){             
               
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($ciudad);
            $em->flush();

            dump($ciudad);
           return $this->redirectToRoute('ciudad_lista');
        }
         return $this->render('ciudad/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
}