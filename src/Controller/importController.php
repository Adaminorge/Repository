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


        if (($h = fopen($file['plik'],"r")) !== FALSE)
                {
                    $marker=1;
                    $doZamiany=["\n","\""];
                    while (( $wiersz=fgets($h))!==false)
                    {

                       $data= new Data();

                           $data->setDane(str_replace( $doZamiany, "", $wiersz));
                           $data->setChart($wykres);
                           $data->setMenuId($marker);
                           $entityManager->persist($data);
                           $entityManager->persist($wykres);
                           $entityManager->flush();
                           $marker=0;
                    }


                    fclose($h);




            }else{
                echo "Jakas straszna kupa!";
            }

      //  return $this->render('/templates/open_file.html.twig');
         return $this->redirectToRoute('show_chart',['id'=>$wykres->getId()]);

    }


    /**
     * @Route(path="/odczytaj/{id}", name="odczytaj")
     * @param $id
     * @return
     */
    public function odczytaj($id){

        //header('Content-Type: application/json');

        $entityManager=$this->getDoctrine()->getManager();
        $wynik=$entityManager->getRepository(Data::class)->findBy(array('chart_id'=>$id));


        $i=0;
        foreach ($wynik as $key){
            if($key->getMenuId()==1){
                $label=explode(';',$key->getDane());
            }
            else {
                $dataset = explode(';', $key->getDane());
                $a=array_shift($dataset);
                $b=$dataset;
                $dataset2[$i]=[$a,$b];


                $i++;
            }
        }

        //$data=['label'=>$label,'data'=>$dataset2];

        echo ('<pre>');
        print_r($dataset2);
 //-----------------------------------------------------label
        $labelText="";
        foreach ($label as $key){
            $labelText.='"'.$key.'";';

        }
        $labelText=substr($labelText,0,-1);

        $labelText='labels:['.$labelText.'],';

        echo $labelText;
        //-------------------------------------------------------data

        foreach ($dataset2 as $key){



        }





        return $this;

    }
}

