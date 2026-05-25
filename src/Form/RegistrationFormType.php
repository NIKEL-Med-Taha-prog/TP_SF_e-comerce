<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr'  => ['class' => 'form-control', 'placeholder' => 'exemple@mail.com'],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'             => PasswordType::class,
                'mapped'           => false,
                'invalid_message'  => 'Les mots de passe ne correspondent pas.',
                'first_options'    => [
                    'label' => 'Choisissez un mot de passe',
                    'attr'  => ['class' => 'form-control'],
                ],
                'second_options'   => [
                    'label' => 'Répétez le mot de passe',
                    'attr'  => ['class' => 'form-control'],
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}