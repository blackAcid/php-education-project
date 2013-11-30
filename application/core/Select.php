<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 28.11.13
 * Time: 16:29
 */

class Select {
    private  $table;
    private  $where_val;
   // public $cols_val;
    private  $db;
    private  $sql;
    private $order;
    private  $limit;
    private $innerJoin;
    public function __construct($table, PDO $db)
    {
       $this->table=$table;
       $this->db=$db;
    }
    public function printSmt()
    {
        $result=$this->table;
        var_dump($result);
    }
    public function select($cols)
    {
        $cols=implode(",",$cols);
        $table=$this->table;
        $where=$this->where_val;
        $order=$this->order;
        $limit=$this->limit;
        $innerJoin=$this->innerJoin;
        $this->sql="SELECT $cols FROM `$this->table` $innerJoin $where $order $limit";
      return $this;
    }
    public function where($construct=null)
    {
       $this->where_val="WHERE ".$construct;
        return $this;
    }
    public function order($field,$flag=null)
    {
         switch ($flag)
        {
            case 'ASC':
                $this->order='ORDER BY '.$field.' ASC'; //в восходящем порядке
            break;
            case 'DESC':
                $this->order='ORDER BY '.$field.' DESC';//в обратном
            break;
            default:
                $this->order='ORDER BY '.$field;
        }
            return $this;
    }
    public function limit($count=null,$end=null)
    {
        if (empty($end)){
            $this->limit='LIMIT '.$count;
        }
        else $this->limit='LIMIT '.$count.','.$end;
        return $this;
    }
    public function fetchAll($values=null)
    {
        $query=$this->sql;
        $sql=$this->db->prepare($query);
        if (!empty($values)){
        for($i=0;$i<count($values);$i++) {
            $sql->bindParam($i+1, $values[$i]);
        }
        }
        $sql->execute();
        $result=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->debugDumpParams();
        return $result;
    }
    public function fetch($values=null,$flag=null)
    {
        $query=$this->sql;
        $sql=$this->db->prepare($query);
        if (!empty($values)){
            for($i=0;$i<count($values);$i++) {
                $sql->bindParam($i+1, $values[$i]);
            }
        }
        $sql->execute();
        $result=$sql->fetch(PDO::FETCH_ASSOC);
        $sql->debugDumpParams();
        return $result;
    }
    public function innerJoin($table,$column)
    {
        $this->innerJoin=" INNER JOIN `$table` ON {$this->table}.`$column`=$table.`$column`";
        return $this;
    }
    public function outerJoin($flag)
    {

    }

}