<?php

/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 17:00
 */
Abstract Class Model_Base
{

    protected $db;
    protected $table;
    private $dataResult;

    public function __construct($select = false)
    {
        // объект бд коннекта
        global $dbObject;
        $this->db = $dbObject;

        // имя таблицы
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        $tableName = strtolower($arrExp[1]);
        $this->table = $tableName;

        // обработка запроса, если нужно
        $sql = $this->_getSelect($select);
        if ($sql) $this->_getResult("SELECT * FROM $this->table" . $sql);
    }

    // получить имя таблицы

    private function _getSelect($select)
    {
        if (is_array($select)) {
            $allQuery = array_keys($select);
            foreach ($allQuery as $key => $val) {
                $allQuery[$key] = strtoupper($val);
            }

            $querySql = "";
            if (in_array("WHERE", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "WHERE") {
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if (in_array("GROUP", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "GROUP") {
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }

            if (in_array("ORDER", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "ORDER") {
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            if (in_array("LIMIT", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "LIMIT") {
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    // получить все записи

    private function _getResult($sql)
    {
        try {
            $db = $this->db;
            $stmt = $db->query($sql);
            //var_dump($sql);exit;
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $rows;
    }

    // получить одну запись

    public function getTableName()
    {
        return $this->table;
    }

    // извлечь из базы данных одну запись

    function getAllRows()
    {
        if (!isset($this->dataResult) OR empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    // получить запись по id

    function getOneRow()
    {
        if (!isset($this->dataResult) OR empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    // запись в базу данных

    function fetchOne()
    {
        if (!isset($this->dataResult) OR empty($this->dataResult)) return false;
        foreach ($this->dataResult[0] as $key => $val) {
            $this->$key = $val;
        }
        return true;
    }

    // составление запроса к базе данных

    function getRowById($id)
    {
        try {
            $db = $this->db;
            $stmt = $db->query("SELECT * from $this->table WHERE id = $id");
            $row = $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }

    // обновление записи. Происходит по ID
    public function update()
    {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arrayForSet = array();
        foreach ($arrayAllFields as $field) {
            if (!empty($this->$field)) {
                if (strtoupper($field) != 'ID') {
                    $arrayForSet[] = $field . ' = "' . $this->$field . '"';
                } else {
                    $whereID = $this->$field;
                }
            }
        }
        if (!isset($arrayForSet) OR empty($arrayForSet)) {
            echo "Array data table `$this->table` empty!";
            exit;
        }
        if (!isset($whereID) OR empty($whereID)) {
            echo "ID table `$this->table` not found!";
            exit;
        }

        $strForSet = implode(', ', $arrayForSet);

        try {
            $db = $this->db;
            $db->begintransaction();
            $stmt = $db->prepare("UPDATE $this->table SET $strForSet WHERE `id` = $whereID");
            $result = $stmt->execute();
            $db->commit();
        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "'UPDATE $this->table SET $strForSet WHERE `id` = $whereID'";
            exit();
        }
        return $result;
    }
}

