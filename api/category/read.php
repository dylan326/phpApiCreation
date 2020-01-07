<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog categories object
  $category = new Category($db);
  // Blog categories query
  $result = $category->read();
  // Get row count
  $num = $result->rowCount();
  // Check if any categoriess
  if($num > 0) {
    // categories array
    $categories_arr = array();
    // $categoriess_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $category_item = array(
        'id' => $id,
        'name' => $name
      );
      // Push to "data"
      array_push($categories_arr, $category_item);
      // array_push($categoriess_arr['data'], $categories_item);
    }
    // Turn to JSON & output
    echo json_encode($categories_arr);
  } else {
    // No categoriess
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }