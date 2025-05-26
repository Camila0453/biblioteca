

<?php 
require_once'../../../vendor/autoload.php';
require_once'../../../model/dao/conexion.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use model\dao\Conexion;
$conexion = Conexion::establecer();


$sql = "SELECT  prestamos.id as idPres, prestamos.socio,prestamos.fechaInicio, prestamos.fechaVen,prestamos.tipo,prestamos.estado, socios.apellido as socioApellido,socios.nombre as socioNombre
, ejemplares.codigo as codigoEjemplar, libro.titulo as libro, ejemplarprestamo.fechaDev as fechaDev,ejemplarprestamo.cantRenovaciones as cantReno, ejemplarprestamo.obsDevolucion as obsDev from prestamos
INNER JOIN socios on socios.dni=prestamos.socio
 INNER JOIN ejemplarprestamo on ejemplarprestamo.prestamo=prestamos.id
INNER JOIN ejemplares on ejemplares.codigo=ejemplarprestamo.ejemplar
INNER JOIN libro on libro.id=ejemplares.libro
where prestamos.fechaVen < NOW() and prestamos.estado <>0";

  // $sql = "SELECT * FROM usuarios";
      $stmt = $conexion->prepare($sql);
      if(!$stmt->execute()){
          throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
      }
      $resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);





$html= '<center><h1> Prestamos vencidos </h1><br><br><br></center>';
$html .= '<table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">';
$html .= ' <thead>
                        <tr>
                             <th> #</th>    
                            <th>Socio</th>     
                            <th>Fecha Inicio</th>        
                            <th>Fecha Fin</th>   
                            <th>Fecha Devolución</th>  
                            <th>Cant. Renovaciones</th>  
                            <th>Observaciones</th> 
                           <th>Tipo </th> 
                           <th >Ejemplares</th> 
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>';

$cont=1;
$estado='En sala';
foreach($resultado as $res){
    if($res['tipo']==1){
$estado='A domicilio';
    }
    $html.='<tr  id= "'.$res['idPres'].'" class="">';
    $html.='<td id="inden">' .$cont. '</td>';
    $html.='<td id="">' . $res['socioNombre'].' '.$res['socioApellido']. '</td>';
    $html.='<td id="">' .  $res['fechaInicio']. '</td>';
    $html.='<td id="">'   .$res['fechaVen']. '</td>';
    $html.='<td id="">'   .$res['fechaDev']. '</td>';
   /* $html.='<td id="">' .$res['motivoCan']. '</td>';
    $html.='<td id="">'   .$res['fechaCan']. '</td>';*/
    $html.='<td id="">' .$res['cantReno']. '</td>';
    $html.='<td id="">' .$res['obsDev']. '</td>';
    $html.='<td id="">' .$estado. '</td>';
    $cont++;
}


$html .= '</tbody></table>';

$options= new Options();
$dompdf= new Dompdf($options);
//$dompdf->loadHtml('<center><h1> Reservas </h1></center>');
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("arch.pdf",array("Attachment"=> false));




?>