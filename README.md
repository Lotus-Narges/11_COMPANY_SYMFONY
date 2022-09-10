# DEFINITIONS

## SYMFONY:
Full-stack PHP frame-work that uses a set of reusable components
- Improves productivity
- Developement process will be a lot faster

## MVP (model, view, presenter)

## COMPOSER:
 - Manage dependencies in symfony applications & install symfony components in your project

## HOMEBREW/ SCOOP:
 - Package management system

## SYMFONY CLI:
 - A developer tool which help you to build, run & manage your symfony applications directly through the TERMINAL

## TWIG:
 - The template engine used in symfony

## TEMPLATE ENGINE:
 - They are used when we want rapidly build web applications that are split into different components

## ORM (Object Relational Mapper)

## DOCTRINE:
 - Symfony framework doesn't integrate any component to work with DB but it provides tight integration with a third-party library -> DOCTRINE

 - Doctrine Goal -> Provide powerful tools to make DB interaction easy & flexible

## SQL (Structured Query Language)

## DQL (Data Query Language)

## ROUTE system:
 - Help us to make the link between our methods & with the URL of our navigator

-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------
# SYMFONY COMMANDS

## Create DB:
I) Create the Entities in PHPMYADMIN manually
II) -> symfony console doctrine:database:create

## Create Entity: (1 Entity = 1 repository)
-> symfony console make:entity (EntityName)
    - Creates src/Entity folder -> Creates a seperate file for each entity

## Define Relation Between the Entities:
-> symfony console make:entity (EntityName)
    - If we check the Entity/Entreprise.php ("One To" entity) file -> 2 methods are created which allow us to add/remove the employes (the elements of "To Many" Entity)

## Migration:
-> STEP 1 (Preparation): -> symfony console make:migration
-> STEP 2 (Sending): -> symfony console make:migrations:migrate
    -Creates The tables in DB (Just the first time)

## Fetching objects from DB: (1 Entity = 1 Repository = 1 Controller) 
-> symfony console make:controller
    - Generates a method which make a link between Model & view
    - Each method has it's unique ROUTE
        - Route: Make link between the method & URL of navigateur

## Add a new column (Modify) to an existing Entity:
-> STEP 1 (Preparation): -> symfony console make:entity (EntityName)
-> STEP 2 (Sending): -> symfony console doctrine:schema:update --force
    - When we want to modify the entity, We never do the migration again because it over-write the entity with the new data!

    - for DELETE/ MODIFY a column in a entity -> We never touch the DB, we change everything from symfony (getter & setter -> Entity/EntityName.php)

## Add a Form type:
-> symfony console make:form (EntityName + Type)
    - Creates the Form folder -> 'src/Form'


## Get all the Routes we created:
-> symfony console debug:router
    - List of all the routes in application that we created


-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------
# SYMFONY STRUCTURE

## bin
### consol
### phpunit
-------------------------------------------------------------------------------------------------
## config
### packages
### routes
### bundles.php
### preload.php
### routes.yaml
### services.yaml
-------------------------------------------------------------------------------------------------
## migrations
### Version20220906080623.php 
    - Version(Y m d H i s).php
    - We find all the SQL queries during creation the Entity
-------------------------------------------------------------------------------------------------
## public
### index.php
-------------------------------------------------------------------------------------------------
## src
### Controller
    - EntityController.php
### Entity
    - Entity.php
### Repository
    - EntityRepository.php
### Form
    - EntityType.php
### kernel.php

-------------------------------------------------------------------------------------------------
## templates
### base.html.twig
    - The main template page







-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------
# SYMFONY CLASS
## ManagerRegistory:
 - An implemented class -> whenever we want to communicate with DB



-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------
# NATIVE FUNCTIONS
## render(fileName, Array)
    - Connection to the templates
    - accepts 2 parameters (FileName,  Array_store_data_from_DB)

## asset()
    - Make reference to the public folder

## load()
    - Load the data into the table

## form()
    - Twig native function to show a form

## up()
    - When a system is being migrated, it will wrap the up methods from all migrations available

## down()
    - It will undo whatever has been done in up()

## path()
    - Make the link from a METHOD of controller through the name of the ROUTE

## persist()
    - tell Doctrine you want to (eventually) save the data related to table (no queries yet)
    
## flush()
    - actually executes the queries (INSERT query)





