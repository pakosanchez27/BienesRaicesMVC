<fieldset>
                <legend>Información General</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
                
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="vendedor[apellido]" placeholder="apellido vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

                <label for="telefono">telefono:</label>
                <input type="text" id="telefono" name="vendedor[telefono]" placeholder="telefono del  vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
            </fieldset>