<?php


namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ChartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {

        $formBuilder
            ->add('title', TextType::class,['data'=>'Unknown'])
            ->add('display', CheckboxType::class, ['label'=>'Display','data'=>true])
            ->add('position', ChoiceType::class, ['choices'=>[
                'top'=>'top',
                'bottom'=>'bottom',]])
            ->add('fontSize', TextType::class,['data'=>'18'])
            ->add('fontColor',ChoiceType::class,['choices'=>['black'=>'black','red'=>'red','blue'=>'blue'],'data'=>'black'])
            ->add('borderWidth', TextType::class,['data'=>'1'])
            ->add('legend', CheckboxType::class,['label'=>'Legend','data'=>true])
            ->add('legendPos', ChoiceType::class,['choices'=>[
                'left'=>false,
                'right'=>true,],'data'=>true])
            //->add('plikzdanymi',FileType::class,['label'=>'Fil med data'])
            ->add('Submit',SubmitType::class);


    }
}