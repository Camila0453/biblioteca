

<?php 
require_once'../../../vendor/autoload.php';
require_once'../../../model/dao/conexion.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use model\dao\Conexion;
$conexion = Conexion::establecer();


$sql = " SELECT reservas.id as idRes,
reservas.socio as idSo,
reservas.fechaInicio,
reservas.fechaFin,
reservas.estado as estadoRes, ejemplares.codigo as ejem, libro.titulo
from reservas
inner join ejemplarreserva on reservas.id= ejemplarreserva.reserva
inner join ejemplares on ejemplares.codigo= ejemplarreserva.ejemplar
inner join libro on libro.id= ejemplares.libro
where reservas.estado= 1 or reservas.estado= 2
order by reservas.id";
// $sql = "SELECT * FROM usuarios";
$stmt=$conexion->prepare($sql);
if(!$stmt->execute()){
throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
}
$resultado= $stmt->fetchAll(\PDO::FETCH_ASSOC);




$html= '<center><h1> Todas las Reservas (Retiradas y activas) </h1><br<br><br></center>';
$html .= '<table id= "tablaClientes" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">';
$html .= ' <thead>
                        <tr>
                            <th> #</th>    
                            <th>Socio</th>   
                            <th>Fecha Inicio</th>        
                            <th>Fecha Fin</th>   
                            <th >Estado</th> 
                            <th >Ejemplares</th> 
                           <th ></th> 
                        </tr>
                    </thead>
                     <tbody id="tablaProductos">
                     
                       
                   </tbody>';

$cont=1;
foreach($resultado as $res){
    $html.='<tr  id= "'.$res['idRes'].'" class="">';
    $html.='<td id="inden">' .$cont. '</td>';
    $html.='<td id="">' . $res['idSo']. '</td>';
    $html.='<td id="">' .  $res['fechaInicio']. '</td>';
    $html.='<td id="">'   .$res['fechaFin']. '</td>';
   /* $html.='<td id="">' .$res['motivoCan']. '</td>';
    $html.='<td id="">'   .$res['fechaCan']. '</td>';*/
    $html.='<td id="">' .$res['estadoRes']. '</td>';
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