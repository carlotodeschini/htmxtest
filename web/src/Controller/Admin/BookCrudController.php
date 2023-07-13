<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Admin\Field\AuthorChoiceField;
use App\Admin\Field\AuthorAssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            // this is working
            // AssociationField::new('author'),

            // but this, with the same EA FieldType, is NOT working, this fires the following error:
            // An error has occurred resolving the options of the form "Symfony\Bridge\Doctrine\Form\Type\EntityType": The required option "class" is missing.
            // AuthorAssociationField::new('author'),

            // so I tried with a copy of the ChoiceField, forcing two authors, but the choices are empty
            AuthorChoiceField::new('author')
            ->setChoices([
                'First author' => 'first',
                'Second author' => 'second'
            ]),

        ];
    }

}
