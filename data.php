<html>
<?php 
include_once "functions.php";
include_once "Classes/studentsClass.php";
include_once "Classes/corseClass.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>File Upload</title>
    
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

<form method="post" action='data.php' enctype='multipart/form-data'>
    Select File : <input type='file' name='filename'>
    <input type='submit' value ='Upload'>
</form>

</html>
<?php

    if($_FILES){
        echo "file uploaded successfully!<br>";
        $fileName = $_FILES['filename']['name'];
        move_uploaded_file($fileName,'/../Dtabase/');
        echo "<pre>";

        // call function to read from file and retun arrays
        $dataArrays = readThisFile($fileName);

        $headers = $dataArrays['headersArray'];
        $values = $dataArrays['valuesArray'];

        $resArray = createAssocArray($headers,$values);
        // create table to display content of associativa array
        createTable($resArray);

        $stuentHeaders = array($headers[0],$headers[1],$headers[2],$headers[3]);
        $courseHeaders = array($headers[4],$headers[5],$headers[8],$headers[9]);
        $coueseTakenHeaders = array($headers[0],$headers[4],$headers[6],$headers[7],$headers[10]);

       // initializeDatabase($stuentHeaders,'Database\StudentDatabase.csv');
       // initializeDatabase($courseHeaders,'Database\CourseDatabase.csv');
       // initializeDatabase($coueseTakenHeaders,'Database\CourseTakenDatabase.csv');

        //populating databases
        foreach ($resArray as $item){
            $stu1 = new Student($item['Student Number'],
                                $item['Name'],
                                $item['Surname'],
                                $item['Birthdate']);
            
            $coursel = new Course($item['Course Code'],
                                  $item['Course Name'],
                                  $item['Instructor name'],
                                  $item['Credits']);
            
            $coueseTaken1 = new CourseTaken($item['Student Number'],
                                            $item['Course Code'],
                                            $item['Course Year'],
                                            $item['Course Semester'],
                                            $item['Grade']);

            print_r($coueseTaken1);
            echo "--------<br>";

        }


    }


    
?>