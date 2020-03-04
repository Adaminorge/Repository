<?php


namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ChartType extends AbstractType
{




    public function buildForm(FormBuilderInterface $formBuilder, array $options)
        {



        $formBuilder
            ->add('title', TextType::class,)
            ->add('display', CheckboxType::class,)
            ->add('position', ChoiceType::class, ['choices'=>[
                'top'=>'top',
                'bottom'=>'bottom',]])
            ->add('fontSize', TextType::class,)
            ->add('fontColor',ChoiceType::class,['choices'=>['black'=>'black','red'=>'red','blue'=>'blue'],'data'=>'black'])
            ->add('borderWidth', TextType::class,)
            ->add('legend', CheckboxType::class,)
            ->add('legendPos', ChoiceType::class,['choices'=>[
                'left'=>false,
                'right'=>true,],])
            ->add('Submit',SubmitType::class);



        }


}