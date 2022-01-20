<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
require '../vendor/autoload.php';


/**
Username: 4Z0PvflNWl
Database name: 4Z0PvflNWl
Password: wTq9yrRwVU
Server: remotemysql.com
Port: 3306
 */


Flight::register('db', 'PDO', array('mysql:host=remotemysql.com;dbname=4Z0PvflNWl','4Z0PvflNWl','wTq9yrRwVU'));

Flight::route('GET /users', function(){
    $users = Flight::db()->query('SELECT * FROM user', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($users);
});

Flight::route('GET /students', function(){
    $students = Flight::db()->query('SELECT user.userid, user.first_name, user.last_name, user.email, user.phone_number, user.address FROM user, student WHERE student.userid = user.userid', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($students);
});

Flight::route('GET /professors', function(){
    $professors = Flight::db()->query('SELECT user.userid, user.first_name, user.last_name, user.email, user.phone_number, user.address FROM user, professor WHERE professor.userid = user.userid', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($professors);
});

Flight::route('GET /courses', function(){
    $courses = Flight::db()->query('SELECT * FROM courses', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($courses);
});



Flight::route('DELETE /user/@id', function($id){
    $delete = 'DELETE FROM user WHERE id = :id';
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute([":id" => $id]);
});

Flight::route('DELETE /course/@id', function($id){
    $delete = 'DELETE FROM courses WHERE id = :id';
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute([":id" => $id]);
});

Flight::start();
?>
