<?php
include_once "entityClass.php";

class Student extends Entity{

    //contants
    const DB_Students = 'database_Students.csv';
    const DB_CoursesTaken = 'database_CoursesTaken.csv';
    const DB_Courses = 'database_Courses.csv';

    //initial properties
    protected $name, $surname;
    protected $studentNum;
    protected $birthDate;

    //derived properties
    protected $coursesTaken; //array of courses + grade 
    protected $NumCoursesComplered;
    protected $NumCoursesFailed;
    protected $GPA;
    protected $status;


    //constructor
    function __construct($studentNum,$firstname,$surname,$birthDate){
        // code
        $this->studentNum = $studentNum;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        //from futinons 
       //  $this->GPA = $GPA;
      //  $this->coursesTaken = $coursesTakenArray;
     // $this->status = $status;



    }


    //creating a new student entry

    // checks stundentdatabace for entry with this student num
    protected function checkStudentDatabace(){

        $resArray = $this->readFile(self::DB_Students);

        $doesStudentExist = FALSE;
        foreach ($resArray as $item){
            if ($item['Student Number'] == $this->studentNum){
                $doesStudentExist = TRUE;
            }
        }

        return $doesStudentExist;
    }

    // creates entry in databace with initial properties
    protected function checkStudententry(){
        //echo "<br>Studnet : In createEntry<br>";
        $fileName = self::DB_Students;
        $arrayToWrite = array ( $this->studentNum,
                                $this->name,
                                $this->surname,
                                $this->birthDate);
        $arrayString = implode(",",$arrayToWrite);
        $arrayString .="/n";

        file_put_contents(self::DB_Students,$arrayString, FILE_APPEND | LOCK_EX );

    }


    //obtaing derived properties

    //getting coursesTaken array for this student
    protected function retrieveCoursesTaken(){

        $resArray = $this->readFile(self::DB_CoursesTaken);

        $coursesTakenArray = array();
        $idx = 0;
        foreach ($resArray as $item){
            if ($item['Student Number'] == $this->studendtNum){
                $dataArray =array(
                    'Course Code' => $item['Course Code'],
                    'Course Year' => $item['Course Year'],
                    'Course Semester' => $item['Course Semester'],
                    'Creadits' => $this->getCourseCredits($item['Course Code']),
                    'Grade' => $item['Grade']);

                $coursesTakenArray[$idx] = $dataArray;
                $idx++;

            }
        }

        $this->coursesTaken = $coursesTakenArray;
        $this->calculateGPA;
        
    }
   
    //getting GPA, numder of courses complered/failed
    protected function calculateGPA(){
        $creditsTot = 0;
        $creditsWeighted = 0;
        $numCoursesFailed = 0;
        $numCoursesComplered = 0;

        foreach($this->coursesTaken as $item){
            $creditsTot += $item['Credits'];
            $creditsWeighted += $item['Credits'] * $this->convertGrade($item['Grade']);

            if($item['Grade'] == 'F'){
                $numCoursesFailed++;
            }else{
                $numCoursesComplered++;
            }
        }

        $this->GPA = $creditsWeighted / $creditsTot;
        $this->NumCoursesComplered = $NumCoursesComplered; 
        $this->NumCoursesFailed = $numCoursesFailed;
        $this->calculateStatus();

    }
  
    //sets status based on GPA
    protected function calculateStatus(){
        $GPA = $this->GPA;

        if($GPA >=4){
            $this->status = "High Honour";

        } elseif($GPA >=3 AND $gpa < 4){
            $this->status = "Honour";

        } elseif($GPA >=2 AND $gpa < 3){
            $this->status = "Satisfactory";

        } else($GPA >=1){
            $this->status = "Unsatisfactory"
        };


    }


    //helper funtions

    //read from a given database and returns data in an associative array
    protected function readFile($database){







    }

    //returns course credits, given courseCode
    protected function getCourseCredits($courseCode){








    }

    //
    protected function convertGrade($grade){
        switch($grade){
            case 'A':
                $value = 5;
                break;
            case 'B':
                $value = 4;
                break;
            case 'C':
                $value = 3;
                break;
            case 'D':
                $value = 2;
                break;
            case 'E':
                $value = 1;
                break;
            case 'F':
                $value = 0;
                break;
        }



    }

    // output funtions

    //
    public function output(){

        $this->retrieveCoursesTaken();

        $outputArray = array(
            'Student Number' =>$this->studentNum,
            'Name' =>$this->name,
            'Surname' =>$this->surname,
            'Birthdate' =>$this->birthDate,
            'No. of Courses Completed' =>$this->NumCoursesCompleted,
            'No. of Courses Failed' =>$this->NumCoursesFailed,
            'GPA' =>$this->GPA,
            'Status' =>$this->status
            );

        return $outputArray;
}



}//end class

?>
