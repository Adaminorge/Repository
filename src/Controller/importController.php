<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class importController
 * @package App\Controller
 *
 */
class importController extends AbstractController
{

    /**
     *
     * @Route(path="/open",methods={"GET"})
     */
    public function openFileController ()
    {


        return $this->render('/templates/open_file.html.twig');


    }



    /**
    *  @Route(path="/open", methods={"POST"})
    */
    public function uploadFileController(Request $request)
    {
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

                //
                //
                //
                //


                $the_big_array = [];
                $wiersz = [];

                if (($h = fopen("{$filename}","r")) !== FALSE)
                {

                    while (($wiersz = fgetcsv($h, 5000, ';'))!== FALSE)
                    {
                        $the_big_array[] = str_replace('""', "", $wiersz);
                    }

                    fclose($h);

                    print_r($the_big_array);
                }

                //
                //
                //
                //

                echo "Success";
            }else{
                print_r($errors);
            }
        }









        return $this->render('/templates/open_file.html.twig');




    }
}

/*
    }
        if (!isset($_POST['Wybierz'])) {

            if (empty($_POST['plik'])) {
                */?><!--
                <div>
                        <h2>Velg en fil<h2>
                        <form action="form.php" method="post">
                        <input type=submit value="<---Tilbake">
                </div>

                --><?php
/*
            } else {


                $plik=$_POST['plik'];

                echo '<br><br><br><br>';
                print_r($_POST);
                print_r($plik);



//---------------------------------------------------------------------------


                $filename = $plik;

                $the_big_array = [];
                $wiersz = [];

                if (($h = fopen("{$filename}","r")) !== FALSE)
                {

                    while (($wiersz = fgetcsv($h, 1000, ';'))!== FALSE)
                    {
                        $the_big_array[] = str_replace('""', "", $wiersz);
                    }


                    fclose($h);
                }



     }       }*/
