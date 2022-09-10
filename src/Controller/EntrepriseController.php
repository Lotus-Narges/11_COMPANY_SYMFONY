<?php

// this file is created when we created the controller -> command generated this file automatically

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\Response\ResponseStream;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// if we want to import a class -> right click -> import class
// with "php namespace resolver" extension -> the classes will be added (use) automatically

class EntrepriseController extends AbstractController
{

    #[Route('/entreprise', name: 'app_entreprise')]
    //! By this function we get the list of all the companies in DB
    public function index(ManagerRegistry $doctrine): Response
    {
        //Get all 'entreprises' From the data base
        $entreprises = $doctrine -> getRepository (Entreprise::class) -> findAll();

        // render('entreprise/...') -> the same name as repository in template
        return $this->render('entreprise/index.html.twig', [
            'entreprises' => $entreprises,
        ]);
    }


    
    #[Route('/entreprise/add', name: 'add_entreprise')]
    #[Route('/entreprise/{id}/edit', name: 'edit_entreprise')]
    // When we want to edit-> We need to specify {id}
    // In the add()->we are able to have 2 routes for Adding & Editing
    //! The function which add new element to the Company entity AND filter the input
    public function add(ManagerRegistry $doctrine, Entreprise $entreprise=null, Request $request): Response
    {  
        //! We need to define what we want to do with this function-> ADD or EDIT?
        //! It will happen with the function below-> if the $employe object doesn't exist already -> We ADD the new object, if not -> We EDIT
        if(!$entreprise){
            $entreprise = new Entreprise();
        }
 
        // $entreprise -> we use in add() & createForm() are the same/ the object of Entreprise class
        // $form -> Gonna create a Form based on the builder in the class in EntrepriseType.php
        $form = $this -> createForm(EntrepriseType::class, $entreprise);

        // Define what happens to Form
        // handlerequest() -> It's gonna analyze what's going on in the query -> allows to takes the data & put it in the form
        $form -> handleRequest($request);
        
        //! Purification § Validation
        if ($form->isSubmitted() && $form->isValid()) {

            // Takes the information from the Formtype & gives value to $entreprise
            //! getData() -> This function get the data about the object that we are working on-> If Employe $employe=null -> getData(), gets no data! 
            $entreprise = $form -> getData();

            // We need to initialize getManager() in order to have access to persist() & flush() 
            $entityManager = $doctrine -> getManager();
            // Preparation
            $entityManager -> persist($entreprise);
            // Execute (INSERT)
            $entityManager -> flush();

            // Allow us to redirect to the page that has the list of all the companies
            return $this -> redirectToRoute('app_entreprise');   
        }
        // Generate the form visually
        return $this -> render('entreprise/add.html.twig', ['formAddEntreprise' => $form -> createView(),
                                                            // if getId() -> exists -> we are in Editing case
                                                            'edit' => $entreprise -> getId()]);
    }



    #[Route('/entreprise/{id}/delete', name: 'delete_entreprise')]
    public function delete(ManagerRegistry $doctrine, Entreprise $entreprise): Response 
    {
        $entityManager = $doctrine -> getManager();
        $entityManager->remove($entreprise);
        $entityManager->flush();
        return $this->redirectToRoute('app_entreprise');
    }




    #[Route('/entreprise/{id}', name: 'show_entreprise')]
    // !The method which gets the id must always be at the end
    // We'll have a list of all the companies -> when we click on each company -> we get all the information about the company
    public function show(Entreprise $entreprise): Response
    {
        // render(Path, Array in controller)
        return $this -> render('entreprise/show.html.twig', ['entreprise' => $entreprise]);
    }



}
