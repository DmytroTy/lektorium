<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Staff;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffType extends AbstractType
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName')
            ->add('createdAt')
            ->add('skills')
            ->add('comments')
            ->add('departments', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'title',
                'multiple' => true
            ])
            ->add('showContacts')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreSubmit')
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }

    public function onPreSetData(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if (true === $user->isShowContacts()) {
            $form
                ->add('email')
                ->add('phone');
        } else {
            $this->email = $user->getEmail();
            $this->phone = $user->getPhone();
        }
    }

    public function onPreSubmit(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if (!$user) {
            return;
        }

        if (isset($user['showContacts']) && $user['showContacts']) {
            $form
                ->add('email')
                ->add('phone');
            $user['email'] = $this->email;
            $user['phone'] = $this->phone;
            $event->setData($user);
        }
    }
}
