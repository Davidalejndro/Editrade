<?php

    if(is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel'])>0){
        //LLamamos a la libreria phpExcel

        require_once 'PHPExcel/Classes/PHPExcel.php';

        $tmpfname = $_FILES['archivosexcel']['tmp_name'];

        //Crear el excel para luego leerlo
        $leerexcel = PHPExcel_IOFactory::createReaderForFile($tmpfname);

        //CARGAR EL EXCEL

        $excelobj = $leerexcel->load($tmpfname);

        //CARGAR EN QUE HOJA TRABAJAREMOS
        $hoja = $excelobj->getSheet(0);
        $filas = $hoja ->getHighestRow();

        echo "<table id = 'tabla_datalle' class = 'table-responsive' style= 'width:100%;
        table-layout:fixed'>
        <thead>
            <tr>
                <td>ID</td>
                <td>PRODUCTOS</td>
            <tr>
        <thead><tbody id='tbody_tabla_detalle'>";

        for($row = 1;$row<=$filas;$row++){
            $ID = $hoja->getCell('A'.$row)->getValue();
            $PRODUCTO = $hoja ->getCell('B'.$row)->getValue();
                echo "<tr>";
                echo "<td>".$ID."</td>";
                echo "<td>".$PRODUCTOS."</td>";
        }
        echo "</tbody></table>";
    }

?>