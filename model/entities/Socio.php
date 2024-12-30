<?php
namespace model\entities;



final class Socio{
    //Atributos
    //Se deben corresponder con los de la tabla CLIENTES
    private $dni, $apellido, $nombres,  $domicilio,$tipoSocio,$estado,$idUsuario,$fechaAlta;
    private $provincia, $localidad, $frenteDni,$dorsoDni, $telefono, $correo; //14

    /**
     * Constructor de la clase
     */
    function __construct()
    {
        //Inicializar los atributos
        $this->apellido = "";
        $this->nombres = "";
        $this->dni = 0;
        $this->domicilio = "";
        $this->provincia = "";
        $this->localidad = "";
        $this->telefono = "";
        $this->correo = "";
        $this->fechaAlta = "";
        $this->tipoSocio = 0;
        $this->estado = 1; //el socio por defecto cuando se crea tiene estado 1 porque esta activo
        $this->idUsuario= 0;
        $this->frenteDni = 0;
        $this->dorsoDni= 0;
    }

    // Getters y Setters
    
    public function getApellido(): string{
        return $this->apellido;
    }
    public function setApellido($apellido): void{

        $this->apellido = ((is_string($apellido))&&(strlen(trim($apellido)) <= 45)) ? trim($apellido) : "";
    }

    public function getNombres(): string{
        return $this->nombres;
    }

    public function setNombres($nombre): void{
        $this->nombres = ((is_string($nombre))&&(strlen(trim($nombre)) <= 45)) ? trim($nombre) : "";
    }

    public function getDni(): string{
        return $this->dni;
    }

    public function setDni($dni): void{
        $dni= trim($dni);
        $this->dni =  is_numeric($dni) &&  strlen($dni)==8 && ctype_digit((string) $dni) ?(int)$dni:0;
    }
    public function setDomicilio($domicilio):void{
        $this->domicilio = ( is_string($domicilio) && (strlen(trim($domicilio)) <=50)) ? trim($domicilio) : "";
    }

    public function getDomicilio(): string{
        return $this->domicilio;
    }

    public function getProvincia(): string{
        return $this->provincia;
    }
 public function setProvincia($provincia): void{
     $this->provincia = ( is_string($provincia) && (strlen(trim($provincia)) <=45)) ? trim($provincia) : "";
 }
 public function setLocalidad($localidad): void{
    $this->localidad = ( is_string($localidad) && (strlen(trim($localidad)) <=45)) ? trim($localidad) : "";
 }
  public function setTelefono($telefono): void{
    $telefono= trim($telefono);
    if(preg_match('/^549\d{9}$/',$telefono)){
          $this->telefono=$telefono;
    }
    else{
        $this->telefono="";
    }
 }
 public function setCorreo($correo): void{
    $correo=trim($correo);
    if(preg_match('"/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/"',$correo)){
       $this->correo=$correo;


    }
    else{
        $this->correo="";
    } //revisargpt
 }
 public function setEstado($estado){
  
   $this->estado=($estado===0 || $estado===1)? trim($estado):0;
 }
 public function setIdUsuario($idUsuario){
    //VER
 }
  public function getLocalidad(): string{
        return $this->localidad;
    }

     public function getTelefono(): string{
        return $this->telefono;
    }

    public function getCorreo(): string{
        return $this->correo;
    }
    public function getEstado():int{
        return $this->estado;
    }

    public function getFechaAlta(): string{
        return $this->fechaAlta;
    }

    public function setFechaAlta($fecha): void{
        $this->fechaAlta = (
            (is_string($fecha))
            &&
            (strlen(trim($fecha)) == 10)
            ) ? trim($fecha) : "";
    }

    // falta el resto de getters y setters

    //Métodos públicos

    public function toJson(): object{
        $json = json_decode('{}');

        $json->{"id"} = $this->getId();
        $json->{"apellido"} = $this->getApellido();
        $json->{"nombres"} = $this->getNombres();
        $json->{"dni"} = $this->getDni();
        $json->{"domicilio"}=$this->getDomicilio();
        $json->{"localidad"}=$this->getLocalidad();
        $json->{"provincia"}=$this->getProvincia();
        $json->{"codPostal"}=$this->getCodPostal();
        $json->{"telefono"}=$this->getTelefono();
        $json->{"correo"}=$this->getCorreo();
        $json->{"fechaAlta"} = $this->getFechaAlta();
        return $json;        
    }
}