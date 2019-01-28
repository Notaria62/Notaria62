<?php
class OperationData
{
    public static $tablename = "operation";

    public function __construct()
    {
        $this->name = "";
        $this->product_id = "";
        $this->q = "";
        $this->cut_id = "";
        $this->operation_type_id = "";
        $this->created_at = "NOW()";
        $this->start_at = "";
        $this->finish_at = "";
        $this->user_id = "";
        $this->item_id = "";
        $this->client_id = "";
    }
    public function getItem()
    {
        return ItemData::getById($this->item_id);
    }
    public function getClient()
    {
        return ClientData::getById($this->client_id);
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (item_id,client_id,start_at,finish_at,user_id) ";
        $sql .= "value (\"$this->item_id\",\"$this->client_id\",\"$this->start_at\",\"$this->finish_at\",\"$this->user_id\")";
        //echo $sql;
        return Executor::doit($sql);
    }

    public function addproduct()
    {
        $sql = "insert into ".self::$tablename." (product_id,q,operation_type_id,sell_id,created_at) ";
        $sql .= "value (\"$this->product_id\",\"$this->q\",$this->operation_type_id,$this->sell_id,$this->created_at)";
        return Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from ".self::$tablename." where id=$id";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from ".self::$tablename." where id=$this->id";
        Executor::doit($sql);
    }

    // partiendo de que ya tenemos creado un objecto OperationData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update ".self::$tablename." set product_id=\"$this->product_id\",q=\"$this->q\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new OperationData());
    }
    public function finalize()
    {
        $sql = "update ".self::$tablename." set returned_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }


    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getRentsByRange($start, $finish)
    {
        $sql = "select * from ".self::$tablename." where (  (\"$start\">=start_at and \"$finish\"<=finish_at) or (start_at>=\"$start\" and finish_at<=\"$finish\") )  and returned_at is NULL ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getByRange($start, $finish)
    {
        $sql = "select * from ".self::$tablename." where returned_at>=\"$start\" and returned_at<=\"$finish\" and returned_at is not NULL ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getEvery()
    {
        $sql = "select * from ".self::$tablename." where returned_at is NULL";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getRents()
    {
        $sql = "select * from ".self::$tablename." where returned_at is NULL";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getAllByItemId($id)
    {
        $sql = "select * from ".self::$tablename." where item_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getAllByItemIdAndRange($id, $start, $finish)
    {
        $sql = "select * from ".self::$tablename." where item_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getAllByClientId($id)
    {
        $sql = "select * from ".self::$tablename." where client_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }
    public static function getAllByClientIdAndRange($id, $start, $finish)
    {
        $sql = "select * from ".self::$tablename." where client_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where name like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }


    public static function getAllByDateOfficial($start, $end)
    {
        $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" order by created_at desc";
        if ($start == $end) {
            $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
        }
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public static function getAllByDateOfficialBP($product, $start, $end)
    {
        $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and product_id=$product order by created_at desc";
        if ($start == $end) {
            $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
        }
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public function getProduct()
    {
        return ProductData::getById($this->product_id);
    }
    public function getOperationtype()
    {
        return OperationTypeData::getById($this->operation_type_id);
    }





    public static function getQYesF($product_id)
    {
        $q=0;
        $operations = self::getAllByProductId($product_id);
        $input_id = OperationTypeData::getByName("entrada")->id;
        $output_id = OperationTypeData::getByName("salida")->id;
        foreach ($operations as $operation) {
            if ($operation->operation_type_id==$input_id) {
                $q+=$operation->q;
            } elseif ($operation->operation_type_id==$output_id) {
                $q+=(-$operation->q);
            }
        }
        // print_r($data);
        return $q;
    }



    public static function getAllByProductIdCutId($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public static function getAllByProductId($product_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id  order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }


    public static function getAllByProductIdCutIdOficial($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
        return Model::many($query[0], new OperationData());
    }


    public static function getAllProductsBySellId($sell_id)
    {
        $sql = "select * from ".self::$tablename." where sell_id=$sell_id order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }


    public static function getAllByProductIdCutIdYesF($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
        return Model::many($query[0], new OperationData());
        return $array;
    }

    ////////////////////////////////////////////////////////////////////
    public static function getOutputQ($product_id, $cut_id)
    {
        $q=0;
        $operations = self::getOutputByProductIdCutId($product_id, $cut_id);
        $input_id = OperationTypeData::getByName("entrada")->id;
        $output_id = OperationTypeData::getByName("salida")->id;
        foreach ($operations as $operation) {
            if ($operation->operation_type_id==$input_id) {
                $q+=$operation->q;
            } elseif ($operation->operation_type_id==$output_id) {
                $q+=(-$operation->q);
            }
        }
        // print_r($data);
        return $q;
    }

    public static function getOutputQYesF($product_id)
    {
        $q=0;
        $operations = self::getOutputByProductId($product_id);
        $input_id = OperationTypeData::getByName("entrada")->id;
        $output_id = OperationTypeData::getByName("salida")->id;
        foreach ($operations as $operation) {
            if ($operation->operation_type_id==$input_id) {
                $q+=$operation->q;
            } elseif ($operation->operation_type_id==$output_id) {
                $q+=(-$operation->q);
            }
        }
        // print_r($data);
        return $q;
    }

    public static function getInputQYesF($product_id)
    {
        $q=0;
        $operations = self::getInputByProductId($product_id);
        $input_id = OperationTypeData::getByName("entrada")->id;
        foreach ($operations as $operation) {
            if ($operation->operation_type_id==$input_id) {
                $q+=$operation->q;
            }
        }
        // print_r($data);
        return $q;
    }



    public static function getOutputByProductIdCutId($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=2 order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }


    public static function getOutputByProductId($product_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=2 order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    ////////////////////////////////////////////////////////////////////
    public static function getInputQ($product_id, $cut_id)
    {
        $q=0;
        return Model::many($query[0], new OperationData());
        $operations = self::getInputByProductId($product_id);
        $input_id = OperationTypeData::getByName("entrada")->id;
        $output_id = OperationTypeData::getByName("salida")->id;
        foreach ($operations as $operation) {
            if ($operation->operation_type_id==$input_id) {
                $q+=$operation->q;
            } elseif ($operation->operation_type_id==$output_id) {
                $q+=(-$operation->q);
            }
        }
        // print_r($data);
        return $q;
    }


    //public static function getRentsByRange($start,$finish){
    //    $sql = "select * from ".self::$tablename." where (  (\"$start\">=start_at and \"$finish\"<=finish_at) or (start_at>=\"$start\" and finish_at<=\"$finish\") )  and returned_at is NULL ";
    //    $query = Executor::doit($sql);
    //    return Model::many($query[0],new OperationData());
    //}



    public static function getInputByProductIdCutId($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public static function getInputByProductId($product_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=1 order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    public static function getInputByProductIdCutIdYesF($product_id, $cut_id)
    {
        $sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new OperationData());
    }

    ////////////////////////////////////////////////////////////////////////////
}
