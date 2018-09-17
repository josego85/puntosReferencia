<!DOCTYPE html>
<html>
<head>
    <title>Puntos de Referencia</title>
    
    <!-- Cabecera -->
    <?php $this->load->view('comunes/cabecera')?>
    
    <script type="text/javascript" charset="utf-8">
        // Iniciar.
        var accion = 'agregar';

        window.onload = localizame(accion);
    </script>
</head>
<body>
    <div class="container cabecera">
        <h1>Marcar Punto de Referencia</h1>
    </div>
    <div class="container">
        <!-- Menu -->
        <?php $this->load->view('comunes/menu')?>
        <br>
    </div>
    <div class="container">
        <form role="form" action="<?php echo base_url();?>puntos/agregarPunto" method='post'>
            <div class="form-group">
                <label>Nombre
                    <span>*</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingresa aqui el nombre del punto de referencia" name="punto_nombre" value="" id="punto_nombre" size="25" />
            </div>
            <div class="form-group">
                <label>Descripci&oacute;n
                    <span>*</span>
                </label>

                <input class="form-control" type="text" placeholder="Descripci&oacute;n del punto de referencia" name="punto_descripcion" value="" id="punto_descripcion" size="25" />
            </div>
            
            <div class="form-group">
                <div class="col-md-10 col-md-offset-1">
                    <input id="punto_latitud" name="punto_latitud" type="hidden" placeholder="Latitud" class="form-control">
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <input id="punto_longitud" name="punto_longitud" type="hidden" placeholder="Longitud" class="form-control">
                </div>
            </div>
            <!-- form-group -->
            
            <div class="form-group">
                <div class="panel-body text-center">
                    <div id="mapa" class="text-align:center mapa">
                    </div>
                </div>
            </div>
            <!-- form-group -->
            
            <input class="btn btn-primary" type="submit" name="submit" value="Agregar" />
       </form>
    </div>
</body>
</html>