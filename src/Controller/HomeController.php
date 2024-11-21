<?php

namespace App\Controller;
use App\Entity\Article;
use Core\View\View;
use ReflectionClass;

class HomeController
{

    public function index()
    {

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
                var_dump($prop->getName());
                $props[$prop->getName()] = $prop->getType()->getName();


            }

            $sqlTableFields = "(";

            foreach ($props as $propName => $propType) {

                switch ($propType) {

                    case 'int' && $propName == 'id':

                        $field = " id INT AUTO_INCREMENT PRIMARY KEY,";
                        break;

                    case 'int':
                        $field = " {$propName} INT,";
                        break;

                    case 'string':
                        $field = " {$propName} LONGTEXT,";

                }
                $sqlTableFields .= $field;
            }
            $sqlTableFields = substr($sqlTableFields, 0, -1).");";


                $sql = $sql.$sqlTableFields;

                var_dump($sql);


                $pdo = \Core\Database\SQL::getPdo();
                $stmt = $pdo->prepare($sql);
                $stmt->execute();





    }
}