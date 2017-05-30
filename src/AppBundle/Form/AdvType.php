<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AdvType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('email')
                ->add('tel')
                ->add('cat', ChoiceType::class, array(
                    'choices' => array(
                        'مسکن' => 'home',
                        'خودرو' => 'car',
                    ),
                ))
                ->add('sub')
                ->add('des')
                ->add('city', ChoiceType::class, array(
                    'choices' => array(
                        'شیراز' => 'shiraz',
                        'تهران' => 'tehran',
                    ),
                ))
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
