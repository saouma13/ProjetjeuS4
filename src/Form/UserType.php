<?php
namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, ['attr'=>['class'=>'label1'],'label'=>' ',])
            ->add('email', EmailType::class, ['attr'=>['class'=>'label1'], 'label'=>' ' ])
            ->add('username', TextType::class, ['attr'=>['class'=>'label1'],'label'=>' ' ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('attr'=>['class'=>'label1'],'label'=>' '),
                'second_options' => array('attr'=>['class'=>'label1'],'label'=>' '),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Users::class,
        ));
    }
}