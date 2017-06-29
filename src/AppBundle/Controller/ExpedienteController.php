<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExpedienteController extends Controller
{
    /**
     * @Route("/prueba/{nombre}-{apellido}", name="prueba")
     */
    public function pruebaAction($nombre, $apellido)
    {
        return $this->render('expediente/prueba.html.twig', array("nombre"=>$nombre, "apellido"=>$apellido));
    }
    /**
     * @Route("/expediente/{id}/show", name="expediente_show")
     */
    public function showExpediente($id){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Expediente');
        $expediente = $repository->find($id);
        return $this->render('expediente/showExpediente.html.twig', array('expediente'=>$expediente));   
    }

     /**
     * @Route("/expedientes/{anio}/show", name="expediente_anio")
     */
    public function showExpedienteanio($anio){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Expediente');
        $expedientes = $repository->findBy(array("anio"=>$anio));
        return $this->render('expediente/listExpediente.html.twig', array('expedientes'=>$expedientes));   
    }
    /**
     * @Route("/expedientes/entre/{desde}-{hasta}/show", name="expediente_entre_anio")
     */
    public function showExpedienteEntreAnio($desde, $hasta){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Expediente');
        $expedientes = $repository->findEntreAnios($desde, $hasta);
        return $this->render('expediente/listExpediente.html.twig', array('expedientes'=>$expedientes));   
    }
    /**
     * @Route("/expedientes/new/{numero}/{anio}/{caratula}", name="expediente_new")
     */
    public function newExpediente($numero, $anio, $caratula){
        
        $expediente = new Expediente();
        
        $expediente->setNumero($numero)
                    ->setAnio($anio)
                    ->setCaratula($caratula);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($expediente);
        $em->flush();
        
        return $this->render('expediente/showExpediente.html.twig', array('expediente'=>$expediente));   
    }
    
}
