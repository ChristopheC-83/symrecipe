<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManager;

class IngredientController extends AbstractController
{
    /**
     * This function display all ingredients
     * 
     * @param IngredientRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     * 
     */


    #[Route('/ingredient', name: 'ingredient.index', methods: ['GET'])]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $ingredients = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        // $ingredients=[];

        // $ingredients = $repository->findAll();
        // dd($ingredients);
        return $this->render('pages/ingredient.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }


    #[Route('/ingredient/ajouter', name: 'ingredient.add', methods: ['GET', 'POST'])]

    public function addIngredient(Request $request, EntityManagerInterface $manager): Response

    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager->persist($ingredient);

            $manager->flush();


            return $this->redirectToRoute('ingredient.index');
        } else {
        }


        return $this->render('pages/addIngredient.html.twig', [
            'form' => $form->createView(),



        ]);
    }
}
