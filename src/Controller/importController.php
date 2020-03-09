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
    public function uploadFileController(Request $request, Chart $chart,$id)
    {

        $entityManager=$this->getDoctrine()->getManager();
        $wykresId=$entityManager->getRepository(Chart::class)->find($id);

        $filename = $request->files->get('plik');

        if(isset($_FILES['plik'])){
            $errors= array();
            $file_name = $_FILES['plik']['name'];
            $file_size =$_FILES['plik']['size'];
            $file_tmp =$_FILES['plik']['tmp_name'];
            $file_type=$_FILES['plik']['type'];

            $tmp = explode('.',$_FILES['plik']['name']);
            $file_ext=strtolower(end($tmp));

            $extensions= array("csv","txt");

            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a CSV or TXT file.";
            }

            if($file_size >20480){
                $errors[]='File size must be max 20 kB';
            }

            if(empty($errors)==true){

                //IMPORT
                //
                //
                //sprawdzic czy sa dane dla chartID
                //

                $sprawdz=$entityManager->getRepository(Data::class)->findBy(array('chart'=>$wykresId));

                if ($sprawdz){
                    throw $this->createNotFoundException('Wykres o Id:'.$wykresId.'juz posiada zapisane dane');

                    }


                //----------------------------------------------------------------------------------------------------
                //skasowac stare dane dla chartId
                //
                //import
                //---------------------------------------------------------------------------


                if (($h = fopen($filename,"r")) !== FALSE)
                {
                    $marker=1;
                    while (!feof($h))
                    {
                       $wiersz=fgets($h);
                       $data= new Data();
                           $data->setChart((int)$wykresId->getId());
                           $data->setDane($wiersz);
                           $data->setMenuId($marker);
                           $entityManager->persist($data);
                           $entityManager->flush();
                           $marker=0;
                    }


                    fclose($h);
                }


                //
                //
                //

                echo "Success";
            }else{
                print_r($errors);
            }
        }









     //   return $this->render('/templates/open_file.html.twig');
        return $this->redirectToRoute('show_chart',['id'=>$wykresId->getId()]);




    }
}

