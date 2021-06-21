<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
require '../vendor/autoload.php';


/**
 * Username: 9ZM2evdyuU
 * Database name: 9ZM2evdyuU
 * Password: kF23TDnhot
 * Server: remotemysql.com
 * Port: 3306
 */


Flight::register('db', 'PDO', array('mysql:host=remotemysql.com;dbname=9ZM2evdyuU','9ZM2evdyuU','kF23TDnhot'));

Flight::route('GET /users', function(){
    $users = Flight::db()->query('SELECT * FROM users', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($users);
});

Flight::route('GET /students', function(){
    $students = Flight::db()->query('SELECT users.id, users.first_name, users.last_name, users.email, users.phone_number, users.address FROM users, students WHERE students.users_id = users.id', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($students);
});

Flight::route('GET /professors', function(){
    $professors = Flight::db()->query('SELECT users.id, users.first_name, users.last_name, users.email, users.phone_number, users.address FROM users, professors WHERE professors.user_id = users.id', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($professors);
});

Flight::route('GET /courses', function(){
    $courses = Flight::db()->query('SELECT * FROM courses', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($courses);
});



Flight::route('DELETE /user/@id', function($id){
    $delete = 'DELETE FROM users WHERE id = :id';
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
