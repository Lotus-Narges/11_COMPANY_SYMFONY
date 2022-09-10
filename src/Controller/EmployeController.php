<?php

// this file is created when we created the controller -> command generated this file automatically

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// if we want to import a class -> right click -> import class
// with "php namespace resolver" extension -> the classes will be added (use) automatically

class EmployeController extends AbstractController
{

    #[Route('/employe', name: 'app_employe')]

    //! This function allow us to show all the employes
    public function index(ManagerRegistry $doctrine): Response
    {   
        // findby -> Accepts 2 parameters: 1) -> is condition (WHERE) & 2) -> ORDER/GROUP BY
        // EX: findby( [ "ville" => "strasbourg" ], [ "nom" => "ASC" ]);
        // SELECT * FROM employe WHERE vill="starsbourg" ORDER BY nom ASC;
        $employes = $doctrine -> getRepository(Employe :: class) -> findBy([], ["prenom" => "DESC"]);

        return $this->render('employe/index.html.twig', [
            'employes' => $employes,
        ]);
    }





    #[Route('/employe/add', name: 'add_employe')]
    #[Route('/employe/{id}/edit', name: 'edit_employe')]
     // When we want to edit-> We need to specify {id}
    // In the add()->we are able to have 2 routes for Adding & Editing
    //! The function which add new element to the employe entity AND filter the input

    public function add(ManagerRegistry $doctrine, Employe $employe=null, Request $request): Response
    {
        //! We need to define what we want to do with this function-> ADD or EDIT?
        //! It will happen with the function below-> if the $employe object doesn't exist already -> We ADD the new object, if not -> We EDIT
        if(!$employe){
            $employe = new Employe();
        }

        // $employe -> we use in add() & createForm() are the same/ the object of Employe class
        // $form -> Gonna create a Form based on the builder in the class in EmployeType.php
        $form = $this -> createForm(EmployeType::class, $employe);

        // Define what happens to Form
        // handlerequest() -> It's gonna analyze what's going on in the query -> allows to takes the data & put it in the form
        $form -> handleRequest($request);

        //! Purification § Validation
        if ($form->isSubmitted() && $form->isValid()) {

            // Takes the information from the Formtype & gives value to $employe
            //! getData() -> This function get the data about the object that we are working on-> If Employe $employe=null -> getData(), gets no data!
            $employe = $form -> getData();

            // We need to initialize getManager() in order to have access to persist() & flush() 
            $entityManager = $doctrine -> getManager();
            // Preparation
            $entityManager -> persist($employe);
            // Execute (INSERT)
            $entityManager -> flush();

            // Allow us to redirect to the page that has the list of all the companies
            return $this -> redirectToRoute('app_employe');   
        }
        // Generate the form visually
        return $this -> render('employe/add.html.twig', ['formAddEmploye' => $form -> createView(),
                                                        // if getId() -> exists -> we are in Editing case
                                                        'edit' => $employe -> getId()]);
    }





    #[Route('/employe/{id}/delete', name: 'delete_employe')]
    public function delete(ManagerRegistry $doctrine, Employe $employe): Response 
    {
        $entityManager = $doctrine -> getManager();
        $entityManager->remove($employe);
        $entityManager->flush();
        return $this->redirectToRoute('app_employe');
    }


    //! Get employe by id ->Here we define id in the path which allow us to get the specific id through paramConverter
    // !The method which gets the id must always be at the end
    // each time we want to call sth by 'id' -> we also need to set {id} in the path 
    #[Route('/employe/{id}', name: 'show_employe')]
    public function show(Employe $employe): Response
    {   
        // We don't need to define the id -> paramConverter will detect it automatically
        // render(Path, Array in controller)
        return $this -> render('employe/show.html.twig', ['employe' => $employe]);
    }

}
