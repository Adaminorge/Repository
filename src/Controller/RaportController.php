<?php


namespace App\Controller;


use App\Entity\Raport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaportController extends AbstractController
{
    /**
     * @Route("/", name="raport_index")
     * @return Response
     */

    public function raportIndexControll()
    {
        $entityManager=$this->getDoctrine()->getManager();
        $raports=$entityManager->getRepository(Raport::class)->findAll();


        return $this->render("templates/raport_index.html.twig",["raports"=>$raports]);


    }





}