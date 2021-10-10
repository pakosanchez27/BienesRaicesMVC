<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;






class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;
        $vendedores = Vendedor::all();
        
        $router->render('propiedades/admin', [
           
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
           
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
    

      

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);
           
    
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            // setea una imagen 
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
           
            // Validar
           $errores = $propiedad->validar();
    
           
            // Revisar que el array de errores este vacio
    
                if(empty($errores)) {
    
    
                        
    
                        // Crear la carpeta para subir imagenes 
                        if (!is_dir(CARPETA_IMAGENES)) {
                            mkdir(CARPETA_IMAGENES);
                        }
                     
                
                        
    
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                        $propiedad->guardar();
    
                            
                }
            }
    
            
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
            
            
        ]);
        
    }

    public static function actualizar(Router $router){
        $id = ValidarORedireccionar('/public/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];
            
            $propiedad->sincronizar($args);
    
            // Validacion
            $errores = $propiedad->validar();
    
               // Generar un nombre único
               $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            // Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
               
            }
    
            if (empty($errores)) {
                // Almacenar imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                }
    
                
               $propiedad->guardar();
    
           
          
            }
            
        }
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad, 
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            
    
            if($id) {
    
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    
                    $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                }
    
    
            }

        }
    }
    
    
}


