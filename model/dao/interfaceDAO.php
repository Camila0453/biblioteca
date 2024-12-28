<?php

namespace model\dao;

interface InterfaceDAO{

    /**load
     * Carga un registro específico de la base de datos y la devuelve como una entidad.
     * @param $id Integer Identificador de la base de datos;
     * @return Cliente El objeto cliente correspondiente.
     */
    public function load($id);
    /**
     * Guarda el cliente como un nuevo registro en la base de datos.
     * @param $cliente Nuevo cliente
     * @return void
     */
    public function save($cliente);
    /**
     * Actualiza (replica) los datos del objeto en su correspondiente
     * registro en base de datos.
     * @param $cliente Cliente a modificar
     */
    public function update($cliente);
    /**
     * Elimina de la base de datos el registro correspondiente.
     * @param $id Identificado del registro en base de datos.
     * @return void
     */
    public function delete($id);
    /**
     * Lista o informa los registros en base de datos.
     * @param $filtros Filtros que se aplicarán en la búsqueda.
     */
    public function list($filtros);

}