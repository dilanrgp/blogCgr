<?php

namespace CGR\DGTI\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo')
                ->add('resumen')
                ->add('contenido')
                ->add('fecha')
                ->add('slug')
                ->add('imagen')
                ->add('publicado')
                ->add('fechaInsert')
                ->add('fechaUpdate')
//                ->add('usuarioInsert')
//                ->add('usuarioUpdate')
                ->add('tipoContenido');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CGR\DGTI\BlogBundle\Entity\News'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cgr_dgti_blogbundle_news';
    }


}
