<?php

class Course{

    //contants
    const DB_Students = 'database_Students.csv';
    const DB_CoursesTaken = 'database_CoursesTaken.csv';
    const DB_Courses = 'database_Courses.csv';

    //initial properties
    protected $name, $surname;
    protected $studentNum;
    protected $birthDate;


    protected function checkCorseDatabace(){

        $resArray = $this->readFile(self::DB_Corses);

        $doesCorseExist = FALSE;
        foreach ($resArray as $item){
            if ($item['Corse Number'] == $this->CorseNum){
                $doesCorseExist = TRUE;
            }
        }

        return $doesCorseExist;
    }

        // creates entry in databace with initial properties
        protected function checkCorseentry(){
            //echo "<br>Studnet : In createEntry<br>";
            $fileName = self::DB_Corses;
            $arrayToWrite = array ( $this->CorseNum,
                                    $this->name,
                                    $this->surname,
                                    $this->birthDate);
            $arrayString = implode(",",$arrayToWrite);
            $arrayString .="/n";
    
            file_put_contents(self::DB_Corses,$arrayString, FILE_APPEND | LOCK_EX );
    
        }
    

}


class CourseTaken{}