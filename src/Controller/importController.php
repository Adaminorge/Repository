<?php


namespace App\Controller;

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
     *
     * @Route(path="/import", name="import_file")
     */
    public function importFile(Request $request)
    {
        if ('POST'===$request->getMethod()&& 'POST'!= null){

            var_dump('plik');

        }else
            {
            echo 'brak danych';

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
