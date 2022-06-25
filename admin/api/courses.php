<?php
require_once(__DIR__ . "/../../Includes/Models/Courses.php");
require_once(__DIR__ . "/../../Includes/Functions.php");
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['_method'])) {
    if ($_POST['_method'] == "create") {
        $file = $image = "";
        if ($_FILES['file']) {
            $file = upload($_FILES['file'], __DIR__ . "/../../courses/pdfs/");
            if (!$file) {
                die(json_encode(message("error", "Couldn't upload the pdf file")));
            }
        }
        if ($_FILES['image']) {
            $image = upload($_FILES['image'], __DIR__ . "/../../courses/images/");
            if (!$image) {
                die(json_encode(message("error", "Couldn't upload the image")));
            }
        }
        $course = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'file' => $file,
            'image' => $image
        ];
        $course = Courses::insert($course);
        if ($course) die(json_encode($course));
        else die(message("error", "Couldn't add Course"));
    }
    if ($_POST['_method'] == "update") {
        $id = intval($_POST['id']);
        $course = Courses::get($id);
        //update a course
        $data = [
            "title" => $_POST['title'],
            "description" => $_POST['description']
        ];
        if ($_FILES['image'] && $_FILES['image']['size'] > 0) {
            $image = upload($_FILES['image'], __DIR__ . "/../../courses/images/");
            if (!$image) {
                die(json_encode(message("error", "Couldn't upload the image")));
            }
            $data["image"] = $image;
        }
        if ($_FILES['file'] && $_FILES['file']['size'] > 0) {
            $file = upload($_FILES['file'], __DIR__ . "/../../courses/pdfs/");
            if (!$file) {
                die(json_encode(message("error", "Couldn't upload the pdf file")));
            }
            $data["file"] = $file;
        }
        if ($course->update($data)) {
            die(json_encode($course));
        } else {
            message("error", "Coudln't update the course");
        }
    }
    if ($_POST['_method'] == "delete") {
        //delete a course
        $id = intval($_POST["id"]);
        $course = Courses::get($id);
        if ($course) {
            $bool = $course->delete();
            if ($bool) {
                unlink(__DIR__ . "/../../courses/pdfs/" . $course->file);
                unlink(__DIR__ . "/../../courses/images/" . $course->image);
                die(json_encode($course));
            } else {
                die(message("error", "Couldn't delete the course"));
            }
        } else {
            die(message("error", "Couldn't find the course"));
        }
    }
    if ($_POST['_method'] == "get") {
        //get a course
        $id = intval($_POST["id"]);
        $course = Courses::get($id);
        if ($course) die(json_encode($course));
        else die(message("error", "Couldn't find the course"));
    }
}
header("location: http://" . $_SERVER['HTTP_HOST'] . "/");
