<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 10.11.2017
 * Time: 13.44
 */

namespace database\connectors;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

//TODO When someone inserts a course define classid by classname. Ask the manager to give name of the class to which it will be used to get the right classid.
//TODO You could add a column for attendees, and or dropouts, fails in the table course.
//TODO You should add a column for the teachers name and contact info, you should create first and lastname into the manager table.
class CourseData{
    public static function insertCourse($title,$description,$videoimg,$videopath,$videotime,$showimg,$classname,$istesting,$isshow){
        DB::beginTransaction();
        try{
            $classid = self::getClassid($classname);
            DB::insert('insert into course (title,description,videoimg,videopath,videotime,showimg,class_id,viewnum,learnnum,istesting,isshow,creationtime,updatetime)
            values (?,?,?,?,?,?,?,1,1,?,?,now(),now())',[$title,$description,$videoimg,$videopath,$videotime,$showimg,$classid,$istesting,$isshow]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    public static function getCourseId($title){
        try{
            return DB::select('select courseid from course where title = ?',[$title])[0]->courseid;
        }catch (\Exception $exception){}
    }
    public static function getCourse($idortitle){
        try{
            if(is_numeric($idortitle)) return DB::select('select * from course where courseid = ?',[$idortitle])[0];
            else if(is_string($idortitle)) return DB::select('select * from course where title = ?',[$idortitle])[0];
        }catch(\Exception $exception){
            var_dump($exception);
        }
    }
    public static function getClass($idortitle){
        if(is_numeric($idortitle)) return DB::select('select * from course_class where classid= ?',[$idortitle])[0];
        else if(is_string($idortitle)) return DB::select('select * from course_class where classname= ?',[$idortitle][0]);
    }
    public static function findUserFromCourse($coursetitle,$userid){
        $usercourses=UserData::getUserCourses($userid);
        $courseid = CourseData::getCourseId($coursetitle);
        foreach ($usercourses as $course){
            if($course->course_id==$courseid) return true;
        }
        return false;
    }
    /**
     * @param $classname Name of the class.
     * @return mixed returns the classid as an int
     */
    public static function getClassid($classname){
        try{
            return DB::select('select classid from course_class where classname = ?',[$classname])[0]->classid;
        }catch (\Exception $exception){}
    }
    public static function insertClass($classname,$status){
        DB::beginTransaction();
        try{
            DB::insert('insert into course_class (classname,status,creationtime,updatetime) values (?,?,now(),now())',[$classname,$status]);
            DB::commit();
        }catch (\Exception $exception){
            echo('inserting course_class failed');
            DB::rollBack();
        }
    }
    public static function updateViewnum($title){
        DB::beginTransaction();
        try{
            DB::update('update course set viewnum = viewnum + 1 where title = ?',[$title]);
            DB::commit();
        }catch (\Exception $exception){ DB::rollBack();}
    }
    public static function updateLearnnum($title){
        DB::beginTransaction();
        try{
            DB::update('update course set learnnum= learnnum + 1 where title = ?',[$title]);
            DB::commit();
        }catch (\Exception $exception){ DB::rollBack();}
    }
    public static function examidsCourseIsConnectedTo($idortitle){
        if(is_string($idortitle)) $id = self::getCourseId($idortitle);
        else $id = $idortitle;
        try{
            return DB::select('select examid from exam where course_id = ?',[$id]);
        }catch (\Exception $exception){}
    }
    public static function getVideopath($title){
        try{
            $course = self::getCourse($title);
            return $course->videopath;
        }catch (\Exception $exception){}
    }
    public static function getCourseImagePath($title){
        try{
            $course = self::getCourse($title);
            return $course->videoimg;
        }catch (\Exception $exception){}
    }
}