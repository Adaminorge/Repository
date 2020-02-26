<?php


namespace App\Controller;


use App\Entity\Raport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RaportController extends AbstractController
{
    public function indexRaport()
    {
        $entityManager=$this->getDoctrine()->getManager();
        $raports=$entityManager->getRepository(Raport::class)->findAll();

        return $this->render("Raport/index",["Raports"=>$raports]);


    }

    public function detailsRaport($id)
    {
        return $this->render("Graphen/details.html.twig");

    }



}