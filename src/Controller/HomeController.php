<?php

namespace App\Controller;
use App\Entity\Article;
use Core\View\View;
use DirectoryIterator;
use ReflectionClass;

class HomeController
{

    public function index()
    {

        // faire de la reflection sur une classe
        $article = new Article();

        $reflectionArticle = new ReflectionClass($article);
        $className = $reflectionArticle->getShortName();
        $tableName = lcfirst($className);



        $pluralTableName = $tableName . 's';

        $sql="CREATE TABLE {$pluralTableName} ";

        $props = [];

            $propsFromReflection = $reflectionArticle->getProperties();
            //var_dump($props);
            foreach ($propsFromReflection as $prop) {
               // var_dump($prop->getName());
                $props[$prop->getName()] = $prop->getType()->getName();


            }

            $sqlTableFields = "(";

            foreach ($props as $propName => $propType) {

                switch ($propType) {

                    case 'int' && $propName == 'id':

                        $field = " id SERIAL PRIMARY KEY,";
                        break;

                    case 'int':
                        $field = " {$propName} INT,";
                        break;

                    case 'string':
                        $field = " {$propName} TEXT,";

                }
                $sqlTableFields .= $field;
            }
            $sqlTableFields = substr($sqlTableFields, 0, -1).");";


                $sql = $sql.$sqlTableFields;

               // var_dump($sql);


//
//                $pdo = \Core\Database\SQL::getPdo();
//                $stmt = $pdo->prepare($sql);
//                $stmt->execute();


        //a partir de la requete SQL de creation de table
        //générée, on veut créer un fichier de migration qui
        //va contenir cette requete


        var_dump("coucou");

        $laDate = date("Ymdhis");
        $leContenu = $sql;
        $leDossier = __DIR__."/../../migrations/";

        file_put_contents($leDossier."$laDate-migration.sql", $leContenu);

    // Iterer dans le dossier Entity
    //recuperer chaque nom de fichier
    //s'en servir pour créer un nouvel objet
    //de chacune des entités

    $entityFolder = __DIR__."/../Entity/";

    $entities = [];

   foreach(new DirectoryIterator($entityFolder) as $file)
   {
       if($file->isFile() && $file->getExtension() == "php"){

           //on se debrouille pour enlever ".php"


           $entities[] = substr($file->getFilename(), 0, -4);

       }

   }

   $objectsEntities = [];

   foreach($entities as $entity){

                 $objectName =   "App\\Entity\\" .$entity;

       $objectsEntities[] = new $objectName();

   }

   var_dump($objectsEntities);




    }
}