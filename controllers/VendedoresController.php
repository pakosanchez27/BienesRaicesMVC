<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;


Class VendedoresController{
    public static function crear(Router $router){

        $vendedor = new Vendedor; 
        $errores = Propiedad::getErrores();
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva instancia 
            $vendedor = new Vendedor($_POST['vendedor']);
            
            // Validar que no alla campos vacios 
    
            $errores = $vendedor->validar();
    
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
        
    }

    public static function actualizar(Router $router){
        $id = ValidarORedireccionar('public/admin');

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los valores
            $args = $_POST['vendedor'];
           
            $vendedor->sincronizar($args);
            
            // Validacion
            $errores = $vendedor->validar();
    
            if(empty($errores)){
    
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar',[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            
    
            if($id) {
    
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
    
    
            }


           
        }
    }
}