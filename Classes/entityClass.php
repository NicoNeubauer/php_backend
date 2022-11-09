<?php


class Entity {
    static $numStudent = 0;
    static $numCourses = 0;


    function __construct() {
        $classType = get_class($this);

        if( $classType == "Student"){
            self::$numStudent++;
        }elseif( $classType == "Course"){
            self::$numCourses++;
        }


    }   
}



?>