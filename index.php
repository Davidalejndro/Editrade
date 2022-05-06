<!doctype html>
<html lang="es">
        <head>
            <!--required meta tags-->
            <meta charset="utf-8">
            <meta name ="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
       
        
    
        
       
<!-- Librerias -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link rel="stylesheet" href="/your-path-to-fontawesome/css/all.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="css/font-awesome-animation.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <!-- SweetAlert2 -->
        <script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
        <script src="sweetalert2.all.min.js"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link rel = "stylesheet" href = "animate.min.css" >
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet">

        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>


        <z:processCSS/>

        <style>
            .table-cabecera tr td {
                padding: 5px !important;
            }
            .inputImportador {
                width: 50% !important;
            }
            label {
                width: 50% !important;
            }
            #spanNoMostrarOpcion label {
                font-weight: 100 !important;
                margin-top: 10px;
            }
            .well.well-sm {
                margin-top: 0 !important;
                margin-bottom: 20px !important;
            }
        </style>

       
        <script type="text/javascript" src="${urlContext}/js/jquery-1.10.2.min.js"></script>

            <!-- Bootstrap CSS -->

            <link rel ="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

            <title>Prueba de lectura de archivo XLSX</title>
    </head>

    <body>
        <div class="col-lg-12" style="padding-top:20px">
            <div class="card">
                <div class="card-header">
                    <b>Importar Excel</b>   
                </div>
                
                <div class="card-body">

                <div class="row">
                       <!-- <div class="col-lg-10"> -->

                <table class="table-cabecera">
                <tr>
                    <td>  
                    <?php  $checked = true; ?>
                    <input type="radio" name="consulta" value = "consulta_individual" id="consulta" <?php echo ($checked== 'true') ?  "checked" : "" ;  ?>> Consulta Individual
                    <input type="radio" name="consulta" value = "consulta_masiva" id="consulta" <?php echo ($checked== 'true') ?  "" : "checked" ;  ?>> Consulta Masiva 

                        <div class="well well-sm">
                            <b><i class="fas fa-paperclip"></i> Archivo</b>
                            <br>
                            <div class="grey-text" style="padding: 5px 0 !important;">Seleccione a continuación el archivo que contiene los chassis</div>
                                <button type="button" id="btnSeleccionarArchivo" class="btn btn-default btn-block">
                                 <i class="fa fa-search" aria-hidden="true"></i> Seleccionar archivo
                                </button>

                            <?php
                            
                                if(!empty ($limitetamanoArchivoCargaOC)){
                            ?>
                                <span class="text-danger">Límite de tamaño de archivo:</span> ${limitetamanoArchivoCargaOC} MB
                                    <br><br>
                            <?php
                                }
                            ?>
                            

                            <b>Archivo seleccionado:</b>
                            <br>
                            <input id="fileContent" name="fileContent" type='file' style="display:none;"/>
                            <span>Nombre de archivo:</span><span id="nombreArchivo" class="text-primary"></span><br>
                            <span>Tamaño:</span><span id="tamanoArchivo" class="text-primary"></span>

                            
                        </div>
                        
                    </td>

                </tr>
              

                </table>
                            
                       

                    </div> 
                    <div class="col-lg-2">
                            <button type="button" name="btnProcesarArchivo" id="btnProcesarArchivo" class="btn btn-primary btn-block" onclick = "CargarExcel()">
                            <i class="fa fa-upload"></i> Procesar archivo
                            </button>
                      
                         </div>
                </div> 
                
            </div>
        </div> 



<!--JavaScript-->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 


<script>
 $('input[type="file"]').on('change', function(){
     var ext = $( this ).val().split('.').pop();
     if($( this ).val() != ''){
         if(ext == "xls" || ext == "xlsx"){
         }
         else
         {
            $( this ).val('');
            Swal.fire("Mensaje de Error","Extensión no permitida: " + ext+"","error");
         }
     }
 });

 function CargarExcel(){
     var excel = $("#txt_archivo").val();
     if(excel===""){
         return Swal.fire("Mensaje de Advertencia","Seleccionar un archivo excel","warning");

     }

     var formData = new FormData();
     var files  = $("#txt_archivo")[0].files[0];
     formData.append('archivoexcel',files);
     $.ajax({
         url:'importar_excel_ajax.php',
         type:'post',
         data:formData,
         contentType:false,
         processData:false,
         success : function (resp){

         }
     });
     return false;  
 }

 $('#fileContent').change(function (event) {
                    for (var i = 0; i < event.target.files.length; i++) {
                        var nombreArchivo = event.target.files[i].name;
                        var tamanoArchivo = event.target.files[i].size;
                        $('#nombreArchivo').text(' ' + nombreArchivo);
                        $('#tamanoArchivo').text(' ' + humanFileSize(tamanoArchivo, true));
                    }
                });

</script>

</body>
</html>
