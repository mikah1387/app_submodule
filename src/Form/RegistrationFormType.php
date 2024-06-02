<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom',
                    
                    'label' => 'Nom :',
                    'required' => true,
 
                ],
                'constraints' => [

                    new NotBlank([
                        'message' => 'vous devrez renseigner votre nom',
                    ]),
                    new Length([    
                        'min' => 3,
                        'minMessage' => 'votre nom doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'votre nom doit contenir au maximum {{ limit }} caractères',     
                        
                    ])  
                ]
                
               
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prenom',
                    'label' => 'Prenom :',
                  
                    'required' => true,    
                ],
                'constraints' => [

                    new NotBlank([
                        'message' => 'vous devavez renseigner votre prenom',
                    ]),
                    new Length([    
                        'min' => 3,
                        'minMessage' => 'votre prenom doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'votre prenom doit contenir au maximum {{ limit }} caractères',     
                        
                    ]) 
                ]
                
              
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'label' => 'Email :',
                    'required' => true,
                ],
                'constraints' => [

                    new NotBlank([
                        'message' => 'vous devrez renseigner votre email',
                
                    ]),
                    new Regex([  
                        'pattern' => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                        'message' => 'entrer un email valide'
                        
                    ])
                ]
            ])
          
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'vous devrez accepter les termes.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
