<?php


namespace App\Controller;


use App\Entity\Chart;
use App\Entity\Data;
use App\Type\ChartType;
use App\Type\NewChartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class chartController extends AbstractController
{
    /**
     * @return Response
     * @Route(path="/createChart", name="create_chart")
     */
    public function createChart(Request $request)
    {
        $chart=new Chart();
        $chart->setDate();
        $chart->setDisplay(1);
        $chart->setBorderWidth(1);
        $chart->setFontSize(18);
        $chart->setFontColor('black');
        $chart->setLegend(1);
        $chart->setLegendPos('right');
        $chart->setPosition('top');



        $form=$this->createForm(NewChartType::class, $chart);


        if ($request->isMethod("post")) {
            $entityManager = $this->getDoctrine()->getManager();

            $form->handleRequest($request);

            $chart=$form->getData();


            $entityManager->persist($chart);
            $entityManager->flush();

            return $this->redirectToRoute("show_all");//----------------------------------------zmienic rute na import?
        }

        return $this->render("templates/addChart.html.twig", ["form"=>$form->createView()]);





    }

    /**
     * @param $id
     * @return Response
     * @Route("/chart/{id}", name="show_chart")
     */
    public function showChart($id)
    {
        $chart=$this->getDoctrine()->getRepository(Chart::class)->findOneBy(["id"=>$id]);

        if(!$chart){

            throw $this->createNotFoundException('Ikke funnet!'.$id);
        }

        return $this->render("/templates/showChart.html.twig",["chart"=>$chart]);
    }

    /**
     * @param $id
     * @Route(path="/editChart/{id}", name="edit_chart")
     */
    public function editChart(Request $request,$id)
    {


        $entityManager=$this->getDoctrine()->getManager();

        $chart=$entityManager->getRepository(Chart::class)->find($id);

        $form=$this->createForm(ChartType::class, $chart);







        if (!$chart)
            {
                throw $this->createNotFoundException('Det er ikke chart med id: '.$id);
            }




        $chart=$form->getData();


        $this->render("templates/addChart.html.twig", ["form"=>$form->createView(),'id'=>$chart->getId()]);
        $form->handleRequest($request);



        $entityManager->persist($chart);
        $entityManager->flush();

        //return $this->redirectToRoute('show_chart',['id'=>$chart->getId()]);
        return $this->render("templates/addChart.html.twig", ["form"=>$form->createView(),'id'=>$chart->getId()]);
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
