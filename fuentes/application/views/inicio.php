<!DOCTYPE html>
<html>
<head>
    <title>Puntos de Referencia</title>
    
    <!-- Cabecera -->
    <?php $this->load->view('comunes/cabecera')?>
</head>
<body>
    <div class="container cabecera">
        <h1>Puntos de Referencia</h1>
    </div>
    <div class="container">
        <!-- Menu -->
        <?php $this->load->view('comunes/menu')?>
    </div>
    <div class="container">
        <!-- Mensaje descatacado -->
        <div class="jumbotron">
            <div class="container">
                <p>
                    Se muestran todos los puntos de referencia!!!
                </p>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div id="mapa">
        </div>
    </div>
    <!-- Pie de pagina -->
    <?php $this->load->view('comunes/pie_pagina')?>
</body>
</html>