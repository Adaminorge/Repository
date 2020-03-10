<?php


namespace App\Controller;


use App\Entity\Chart;
use App\Entity\Data;
use App\Type\ChartType;
use App\Type\NewChartType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Encoder\ContentEncoderInterface;
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
        $deleteForm=$this->createFormBuilder()
            ->setAction($this->generateUrl("delete_chart",["id"=>$chart->getId()]))
            ->setMethod(Request::METHOD_DELETE)
            ->add("submit", SubmitType::class, ["label"=>"Delete"])
            ->getForm();

        $openForm=$this->createFormBuilder()
            ->setAction($this->generateUrl("open_file",["id"=>$chart->getId()]))
            ->setMethod(Request::METHOD_POST)
            ->add("submit", SubmitType::class, ["label"=>"Import data"])
            ->getForm();


        return $this->render("/templates/showChart.html.twig",["chart"=>$chart,"deleteForm"=>$deleteForm->createView(),"openForm"=>$openForm->createView()]);
    }

    /**
     * @param $id
     * @Route(path="/editChart/{id}", name="edit_chart")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * @Route("/delete/{id}", name="delete_chart", methods="DELETE")
     * @param Chart $chart
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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


    /**
     * @Route(path="/openfile/{id}", name="open_file", methods="POST")
     *
     *
     */
    public function openFileController($id){

        $entityManager=$this->getDoctrine()->getManager();
        $chart=$entityManager->getRepository(Chart::class)->find($id);

        $openForm=$this->createFormBuilder()
            ->setAction($this->generateUrl("wczytaj",["id"=>$chart->getId()]))
            ->setMethod(Request::METHOD_POST)
            ->add("plik", FileType::class)
            ->add("submit", SubmitType::class, ["label"=>"Import data"])
            ->getForm();


        return $this->render("/templates/open_file.html.twig",["openForm"=>$openForm->createView()]);


    }

}
