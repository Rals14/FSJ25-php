<?php 
    require_once './config/database.php';
    require_once './models/Product.php';

    class ProductController{
        public $product;
        public $db;


        public function __construct()
        {
            $database = new Database();
            $this->db = $database->getConnection();
            $this->product = new Product($this->db);
        }

        public function read(){
            // Logica para Leer productos
            $sentence = $this->product->read();
            $products = $sentence->fetchAll(PDO::FETCH_ASSOC);
            include './views/home.php';

        }

        public function create(){
            //Logica para crear productos
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                print_r($_POST);
                $this->product->name = $_POST['nombre'];
                $this->product->price = $_POST['precio'];
                $this->product->quantity = $_POST['cantidad'];
                $this->product->provider = $_POST['proveedor'];

                $this->product->create();

            }
    
            include './views/create.php';
        }

        public function update($id){
                //Logica para actualizar producto
                $sentence = $this->product->findOne($id);
                $product = $sentence->fetch(PDO::FETCH_ASSOC);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->product->id = $id;
                    $this->product->name = $_POST['nombre'];
                    $this->product->price = $_POST['precio'];
                    $this->product->quantity = $_POST['cantidad'];
                    $this->product->provider = $_POST['proveedor'];
                    
                    $this->product->update();
                }

                include './views/edit.php';

        }

        public function delete($id){
            $sentence = $this->product->delete($id);
            header('Location: /index.php?action=read');
        }

    }

?>