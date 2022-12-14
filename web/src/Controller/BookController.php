<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('/', name: 'app_book_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('book/index.html.twig');
    }

    #[Route('/list', name: '_app_book_list', methods: ['GET'])]
    public function index_table(BookRepository $bookRepository): Response
    {
        return $this->render('book/_list.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/new', name: '_app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BookRepository $bookRepository): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book, [
            'action' => $this->generateUrl('_app_book_new')
            ]
        );
        $formAction = $this->generateUrl('_app_book_new');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->add($book, true);

            // force 204 as return code to allow to close the modal and a custom htmx header
            // to refresh the book list
            $response = new Response('', 204, [
                'HX-Trigger' => 'bookListChanged'
            ]);
            return ($response);
        }

        $response = $this->renderForm('book/_new_edit_modal.html.twig', [
            'modalTitle' => 'Create new Book',
            'action' => $formAction,
            'book' => $book,
            'form' => $form,
        ]);
        // force 200 as return code of the response to make htmx working on form errors
        // because htmx con handle only responses with 200 return code
        // I also set "formnovalidate" to disable HTML5 form submit validation
        $response->setStatusCode(200);
        return ($response);
    }

    #[Route('/{id}', name: '_app_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('book/_show_modal.html.twig', [
            'modalTitle' => 'Book details',
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: '_app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $formAction = $this->generateUrl('_app_book_edit', ['id' => $book->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->add($book, true);

            // force 204 as return code to allow to close the modal and a custom htmx header
            // to refresh the book list
            $response = new Response('', 204, [
                'HX-Trigger' => 'bookListChanged'
            ]);
            return ($response);
        }

        $response = $this->renderForm('book/_new_edit_modal.html.twig', [
            'modalTitle' => 'Edit Book',
            'action' => $formAction,
            'book' => $book,
            'form' => $form,
        ]);
        // force 200 as return code of the response to make htmx working on form errors
        // because htmx con handle only responses with 200 return code
        // I also set "formnovalidate" to disable HTML5 form submit validation
        $response->setStatusCode(200);
        return ($response);
    }

    #[Route('/{id}', name: '_app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        dump ($request->request->get('_token'));
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $bookRepository->remove($book, true);
        }

        // force 204 as return code to allow to close the modal and a custom htmx header
        // to refresh the book list
        $response = new Response('', 204, [
            'HX-Trigger' => 'bookListChanged'
        ]);
        return ($response);
    }
}
