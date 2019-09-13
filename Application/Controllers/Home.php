<?php

use MVC\Controller;

class ControllersHome extends Controller {

    public function index() {

        // Connect to database
        $model = $this->model('home');

        // Read All Task
        $users = $model->getAllUser();

        // Prepare Data
        $data = ['data' => $users];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

    public function post() {

        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('home');

            // Read All Task
            $users = $model->getAllUser();

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }

    public function uploadImage() {
        if(isset($this->request->files['image'])){
            $image = $this->request->files['image'];
            $errors = array();

            // File info
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];

            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            
            // White list extensions
            $extensions = array("jpeg","jpg","png");
            
            // Check it's valid file for upload
            if(in_array($file_ext, $extensions) === false) {
               $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }
            
            // Check file size
            if($file_size > 2097152) {
               $errors[] = 'File size must be exactly 2 MB';
            }
            
            if(empty($errors) == true) {
               move_uploaded_file($file_tmp, UPLOAD . "Images/" . $file_name);
               echo "Success";
            } else {
               print_r($errors);
            }
         }
    }
}
