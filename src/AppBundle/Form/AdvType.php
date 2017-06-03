<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('email')
                ->add('tel')
              ->add('Location', null, ['choice_label' => function( $Location) {
                        return $Location->getLoc();
                    }
                        ]
                )
                ->add('sub')
                ->add('des')
                ->add('categorie', null, ['choice_label' => function( $categorie) {
                        return $categorie->getCat();
                    }
                        ]
                )
                ->add('address')
                ->add('pic', FileType::class, array('label' => 'picture (jpg file)'))
                ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('attr' => array('class' => 'save')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Adv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_adv';
    }

}
