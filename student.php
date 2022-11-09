<?php 

include_once "Classes/studentsClass.php";
include_once "functions.php";
include_once "data.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 5px;
        }
        th {
        text-align: left;
        }
    </style>
</head>
<body>

    <?php

        $dataArrays = readThisFile($fileName);
        $headers = $dataArrays["headerArray"];
        $values = $dataArrays["valuesArray"];

        $stuentsArray = createAssocArray($headers, $values);
        echo "<pre>";

        $idx = 0;
        foreach ($stuentsArray as $item){
            $student1 = new Student ($item["Student Number"],$item["Name"],$item["Surname"],$item["Birthdate"]);

            //rettieve corses by this student 
            $displayArray[$idx] = $student1->qutput();
            $idx++;

        }

        // displaying stuff 
        echo "Number of Students : " . Entity::$numStudent;
        echo "<br><br>";

        print_r($display);

        //sorting 
       // $sortingKey = "GPA";
     //   $sortedArray_desc = rsort($displayArray,$sorting);
       // createTable($sortedArray_desc);

       // echo "Original Table<br>";
      //  createTable($displayArray);
      //  $sortingKey = 'GPA';

        //echo "<br>";
       // echo "Sorted Table - Descendeing<br>";
       // $sortedArray_desc = rsort($displayArray,$sortingKey);
      //  createTable($sortedArray_desc);


      //  echo "<br>";
      //  echo "Sorted Table - Ascendeing<br>";
     //   $sortedArray_asc = sort($displayArray,$sortingKey);
       // createTable($sortedArray_desc);
    ?>

</body>
</html>
