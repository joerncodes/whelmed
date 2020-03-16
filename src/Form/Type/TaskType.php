<?php

namespace App\Form\Type;

use App\Domain\Query\Project\All;
use App\Entity\Project;
use App\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class TaskType extends AbstractType
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;
    /**
     * @var All
     */
    private $allQuery;


    public function __construct(UrlGeneratorInterface $router, All $allQuery)
    {
        $this->router = $router;
        $this->allQuery = $allQuery;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class)
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'title',
                'required' => false,
                'choices' => $this->allQuery->getProjectList()->getProjects(),
            ])
            ->add('flagged', ChoiceType::class, [
                'choices' => ['Flagged' => true, 'Not flagged' => false],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('dueDate', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'title',
            ])
            ->add('save', SubmitType::class)
            ->setAction($this->router->generate('task.add'));
    }
}
