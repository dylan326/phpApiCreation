<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog Category object
  $category = new Category($db);
  // get id from url

  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  //get Category 
  $category->read_single();

  //create array(need json data)

  $category_arr = array(
      'id' => $category->id,
      'name' => $category->name

  );
  

  //make json

  print_r(json_encode($category_arr));