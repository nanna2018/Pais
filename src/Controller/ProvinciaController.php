<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Provincia;
use App\Form\ProvinciaType;


/**
     * @Route("/provincia")
     */
class ProvinciaController extends Controller
{ 

 /**
     * @Route("/lista", name="provincia_lista")
     */
    public function listado()
    {

       $provincia= $this->getDoctrine()->getRepository(Provincia::class);
        $vectorprovincia = $provincia->findAll();
         dump($vectorprovincia);

            return $this->render('provincia/index.html.twig', [
            'provincias'=> $vectorprovincia,

        ]);
    
    }
    /**
     * @Route("/nuevo", name="provincia_nuevo")
     */
    public function nuevo(Request $request)
    {
        
        $provincia=new Provincia();
        $formu=$this->createForm(ProvinciaType::class,$provincia);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){             
               
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincia);
            $em->flush();

            dump($provincia);
            return $this->redirectToRoute('provincia_lista');
        }
         return $this->render('ciudad/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
}