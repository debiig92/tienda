<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 4/16/2018
 * Time: 2:34 PM
 */

class Log extends ORM
{
    private $log_id;
    private $class;
    private $method;
    private $log;


    protected static function getTable(){
        return 'b_log';
    }

    protected static function getPk(){
        return 'log_id';
    }

    public function getLog_Id()
    {
        return $this->log_id;
    }

    public function setLog_Id($log_id)
    {
        $this->log_id = $log_id;
    }

    public function getMethod()
    {
        return $this->method;
    }


    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getClass()
    {
        return $this->class;
    }


    public function setClass($class)
    {
        $this->class = $class;
    }


    public function getLog()
    {
        return $this->log;
    }


    public function setLog($log)
    {
        $this->log = $log;
    }


    public function logTableInsert($classE,$methodE,$logE){
        $this->setClass($classE);
        $this->setMethod($methodE);
        $this->setLog($logE);
        try {
            $result = $this->create();
        } catch (Exception $e) {
            $result = $e;
        }
        return $result;
    }
}