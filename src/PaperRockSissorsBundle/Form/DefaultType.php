<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/7/2016
 * Time: 10:06 AM
 */

namespace PaperRockSissorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DefaultType extends AbstractType
{
    private $fate;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('chooseFate', ChoiceType::class, array(
            'choices' => array(
                'Paper' => 'Paper',
                'Rock' => 'Rock',
                'Scissors' => 'Scissors',
                'Lizard' => 'Lizard',
                'Spock' => 'Spock'
                ))
            )
            ->add('submit', SubmitType::class)
            ->setMethod('POST');
    }

    public function getChooseFate()
    {
        return $this->fate;
    }
    public function setChooseFate($fate)
    {
        $this->fate = $fate;
    }
}
