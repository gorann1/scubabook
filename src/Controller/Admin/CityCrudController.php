<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Field\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('City')
            ->setEntityLabelInPlural('Cities')
            ->setSearchFields(['name', 'description', 'slug'])
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('description')
            ->add('slug')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield CKEditorField::new('description')
            ->hideOnIndex()
        ;
        yield AssociationField::new('region', 'Region')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
        // yield AssociationField::new('zone', 'Zone')->renderAsNativeWidget();

    }



    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
