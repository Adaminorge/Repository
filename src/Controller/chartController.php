<?php


namespace App\Controller;


use App\Entity\Chart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class chartController extends AbstractController
{
    /**
     * @return Response
     * @Route(path="/createChart", name="create_chart")
     */
    public function createChart():Response
    {
        $entityManager=$this->getDoctrine()->getManager();

        $chart=new Chart();
        $chart->setDate();
        $chart->setTitle('Diagram nr 1');
        $chart->setDisplay(true);
        $chart->setLegend(true);
        $chart->setLegendPos('top');
        $chart->setFontSize(18);
        $chart->setFontColor('red');
        $chart->setBorderWidth(1);

        $entityManager->persist($chart);

        $entityManager->flush();

        return new Response('New chart!'.$chart->getTitle());

    }

    /**
     * @param $id
     * @return Response
     * @Route("/chart/{id}", name="show_chart")
     */
    public function showChart($id)
    {
        $chart=$this->getDoctrine()
            ->getRepository(Chart::class)
            ->find($id);

        if(!$chart){

            throw $this->createNotFoundException('Ikke funnet!'.$id);
        }

        return new Response('Chart '.$chart->getTitle());
    }

    /**
     * @param $id
     * @Route(path="/editChart/{id}", name="edit_chart")
     */
    public function editChart($id)
    {
        $entityManager=$this->getDoctrine()->getManager();

        $chart=$entityManager->getRepository(Chart::class)->find($id);

        if (!$chart)
            {
                throw $this->createNotFoundException('Det er ikke diagram med id: '.$id);
            }

        $chart->setTitle('Ny titel');

        $entityManager->flush();

        return $this->redirectToRoute('show_chart',['id'=>$chart->getId()]);
    }


    /**
     * @param $id
     * @Route(path="/delete/{id}", name="delete_chart")
     */
    public function deleteChart($id)
    {
        $entityManager=$this->getDoctrine()->getManager();
        $chart=$entityManager->getRepository(Chart::class)->find($id);

        if (!$chart){
            throw $this->createNotFoundException('Ikke funnet chart med Id:'.$id);

        }

        $entityManager->remove($chart);
        $entityManager->flush();

        return $this->redirect("/showall");
    }


    /**
     * @Route(path="/showall", name="show_all")
     */
    public function allCharts()
    {
        $entityManager=$this->getDoctrine()->getManager();
        $charts=$entityManager->getRepository(Chart::class)->findAll();

        if(!$charts){
            throw $this->createNotFoundException('Det er tomt!');
        }

        return $this->render("templates/show_all.html.twig",["charts"=>$charts]);

    }


}
