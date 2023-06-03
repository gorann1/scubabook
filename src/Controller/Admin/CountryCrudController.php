<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use App\Field\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Country')
            ->setEntityLabelInPlural('Countries')
            ->setSearchFields(['name'])
            ->setSearchFields(['description'])
            ->setSearchFields(['iso3']);


    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('description')
            ->add('iso3')
            ->add('slug')
            ;
    }

    public function configureFields(string $pageName): iterable {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield CKEditorField::new('description')
            ->hideOnIndex()
        ;
        yield TextField::new('iso3');
        yield AssociationField::new('zone', 'Zone')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
    }

}
