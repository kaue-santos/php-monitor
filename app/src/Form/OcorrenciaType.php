<?php

namespace App\Form;

use App\Entity\Ocorrencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OcorrenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('descricao')
            ->add('script')
            ->add('colunaChave')
            ->add('colunas')
            ->add('ativo')
            ->add('tipoOcorrencia')
            ->add('qtdDiasParaAtraso')
            ->add('qtdDiasParaAlertaAtraso')
            ->add('id_categoria')
            ->add('id_area')
            ->add('alertas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ocorrencia::class,
        ]);
    }
}
