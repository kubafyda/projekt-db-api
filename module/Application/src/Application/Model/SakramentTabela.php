<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Exception;

use Application\Entity\Sakrament;

class SakramentTabela {
      protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * 
     * @return array of \Application\Entity\Sakrament;
     * 
     */
    public function getAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * 
     * @return \Application\Entity\Sakrament
     * 
     */
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id'=>$id));
        return $rowset->current();
    }
    
    public function add(Sakrament $rekord) {
        $data = $rekord->extract();
        
        if($this->tableGateway->insert($data)){
            return $this->tableGateway->lastInsertValue;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function update($id, Sakrament $rekord) {
        $data = $rekord->extract();
        if($this->tableGateway->update($data, array('id'=>$id))){
            return $id;
        } else {
            throw new Exception('DB insert project error');
        }
    }
    
    public function delete($id) {
        if($this->tableGateway->delete(array('id' => $id))) {
            return $id;
        } else {
            throw new Exception("DB delete error");
        }
    }
}
