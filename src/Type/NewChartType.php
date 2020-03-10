<?php


namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewChartType extends AbstractType
{




    public function buildForm(FormBuilderInterface $formBuilder, array $options)
        {



        $formBuilder

            ->add('title', TextType::class)
            ->add('Submit',SubmitType::class);



        }


}