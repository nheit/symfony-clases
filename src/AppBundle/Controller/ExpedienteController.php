<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expediente;
use AppBundle\Form\ExpedienteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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
    /**
     * @Route("/expediente/new2", name="expediente_new2")
     */
    public function newExpediente2Action(Request $request){
        $expediente = new Expediente();
        $form = $this->createFormBuilder($expediente)
                ->add('numero', TextType::class)
                ->add('anio', TextType::class)
                ->add('caratula', TextType::class)
                ->add('guardar', SubmitType::class)
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $expedienteSubmitted = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($expedienteSubmitted);
            $em->flush();
            return $this->render('expediente/showExpediente.html.twig', array('expediente'=>$expedienteSubmitted));   
        }
        return $this->render('expediente/newExpediente.html.twig', array('formExpediente'=>$form->createView()));
    }
    /**
     * @Route("/expediente/new3", name="expediente_new3")
     */
    public function newExpediente3Action(Request $request){
        $expediente = new Expediente();
        $form = $this->createForm(ExpedienteType::class, $expediente);
        $form->add('guardar', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $expedienteSubmitted = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($expedienteSubmitted);
            $em->flush();
            return $this->render('expediente/showExpediente.html.twig', array('expediente'=>$expedienteSubmitted));   
        }
        return $this->render('expediente/newExpediente.html.twig', array('formExpediente'=>$form->createView()));
    }
    /**
     * @Route("/expediente/{id}/edit", name="expediente_edit")
     */
    public function editExpedienteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Expediente');
        $expediente = $repository->find($id);
        $form = $this->createForm(ExpedienteType::class, $expediente);
        $form->add('modificar', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $expedienteSubmitted = $form->getData();            
            $em->flush();
            return $this->redirectToRoute("expediente_show", array('id'=>$id));
        }
        return $this->render('expediente/newExpediente.html.twig', array('formExpediente'=>$form->createView()));
    }
}
