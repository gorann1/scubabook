<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use App\Field\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Location')
            ->setEntityLabelInPlural('Locations')
            ->setSearchFields(['name', 'description', 'slug', 'center_id_seq'])
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
        yield TextField::new('ltd');
        yield TextField::new('lng');
        yield AssociationField::new('type', 'Type')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield AssociationField::new('category', 'Category')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield AssociationField::new('visibility', 'Visibility')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield AssociationField::new('depth', 'Depth')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield AssociationField::new('current', 'Current')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', false)
        ;
        yield AssociationField::new('city', 'City')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', true)
        ;
        yield AssociationField::new('center', 'Center')->renderAsNativeWidget()
            ->setFormTypeOptionIfNotSet('multiple', true)
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
