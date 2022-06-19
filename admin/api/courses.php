<?php

require_once(__DIR__ . "/../../Includes/Models/Courses.php");
require_once(__DIR__ . "/../../Includes/Functions.php");

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $file = $image = "";
        if ($_FILES['file']) {
            $tmp_name = $_FILES["file"]["tmp_name"];
            $file = basename($_FILES["file"]["name"]);
            move_uploaded_file($tmp_name, __DIR__ . "/../courses/pdfs/$file");
        }
        if ($_FILES['image']) {
            $tmp_name = $_FILES["image"]["tmp_name"];
            $image = basename($_FILES["image"]["name"]);
            move_uploaded_file($tmp_name, __DIR__ . "/../courses/images/$file");
        }
        $course = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'file' => $file,
            'image' => $image
        ];

        $course = Courses::insert($course);

        die(json_encode($course));
    }
    if ($_POST['_method'] == "update") {
        //update a course
    }
    if ($_POST['_method'] == "delete") {
        //delete a course
    }
}

header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
