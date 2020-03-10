<?php


namespace App\Controller;

use App\Entity\Chart;
use App\Entity\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class importController
 * @package App\Controller
 *
 */
class importController extends AbstractController
{

    /**
    *  @Route(path="/open/{id}", name="wczytaj", methods={"POST"})
    *
    */
    public function loadFileController(Request $request, Chart $chart,$id)
    {



        $entityManager=$this->getDoctrine()->getManager();
        $wykres=$entityManager->getRepository(Chart::class)->find($id);

       $file = $request->files->get('form');

       //echo'<pre>';
       //var_dump($file['plik']);

                //----------------------------------------------------------------------------------------------------
                //skasowac stare dane dla chartId
                //
                //import
                //---------------------------------------------------------------------------


        if (($h = fopen($file['plik'],"r")) !== FALSE)
                {
                    $marker=1;
                    $doZamiany=["\n","\""];
                    while (!feof($h))
                    {
                       $wiersz=fgets($h);
                       $data= new Data();

                           $data->setDane(str_replace( $doZamiany, "", $wiersz));
                           $data->setChart($wykres);
                           $data->setMenuId($marker);
                           $entityManager->persist($data);
                       //    $entityManager->persist($wykres);
                           $entityManager->flush();
                           $marker=0;
                    }


                    fclose($h);



                //
                //
                //

                echo "Success";
            }else{
                echo "Jakas straszna kupa!";
            }










        return $this->render('/templates/open_file.html.twig');
     //     return $this->redirectToRoute('show_chart',['id'=>$wykresId->getId()]);




    }
}

