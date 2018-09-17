<!DOCTYPE html>
<html>
<head>
    <title>Puntos de Referencia</title>
    
    <!-- Cabecera -->
    <?php $this->load->view('comunes/cabecera')?>
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
                <label>Latitud
                    <span>*</span>
                </label>
                <input class="form-control" type="text" name="punto_latitud" id="punto_latitud" value="" placeholder="click en el mapa"/>
            </div>
            <div class="form-group">
                <label>Longitud
                    <span>*</span>
                </label>
                <input class="form-control" type="text" name="punto_longitud" id="punto_longitud" value="" placeholder="click en el mapa"/>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Enviar" />
       </form>
    </div>
    
    <div>
        <!-- Element: Map -->
        <div class='col col-50'>
          <div id='map'></div>
          <div class='left'>
            <a id='geojsonLayer' href='#'></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <form role="form" >
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Ingresa aqui tu busqueda" name="direccion" value="" id="direccion" size="25" />
            </div>
            <button class="btn btn-default" type="button" onclick="direccion_buscador();">Buscador</button>
            <div id="resultado"/>
        </form>
    </div>
    <div id="mapa">
    </div>
</body>
</html>