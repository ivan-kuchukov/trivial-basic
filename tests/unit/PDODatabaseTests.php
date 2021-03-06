<?php

namespace app\tests\unit;
use trivial\models\PDODatabase;
use trivial\models\Database;

/**
 * Tests for PDODatabase class
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class PDODatabaseTests {
    private $db;
    private $n=1;
    private $table="test56365464";
    private $errors=0;

    /**
     * run tests
     * @return boolean
     */
    public function run() {
        echo 'Your local MySQL server must have user "test" with database "test" and password "test".' . PHP_EOL;
        $con = $this->connect();
        $this->validate($con);
        if ($con) {
            $this->clear();
            $this->prepare();
            $this->validate($this->errorConnect());
            $this->validate($this->syntaxErrorWOBind());
            $this->validate($this->syntaxErrorWBind());
            $this->validate($this->ddl());
            $this->validate($this->insert());
            $this->validate($this->select());
            $this->validate($this->insertWithBind());
            $this->validate($this->selectWithBind());
            $this->validate($this->selectArray());
            $this->validate($this->selectScalar());
            $this->validate($this->transaction());
            $this->validate($this->ddlError());
            $this->validate($this->getAffectedRows());
            $this->clear();
            if ($this->errors===0) {
                echo "\033[0;32mAll Done!\033[0;37m" . PHP_EOL;
            } else {
                echo "\033[0;31m" . $this->errors . " error(s)!\033[0;37m" . PHP_EOL;
                exit(1);
            }
        } else {
            echo 'Connection fail! ' . PHP_EOL;
            exit(1);
        }
    }
    
    private function validate($test) {
        if ( $test ) {
            echo "\033[0;32m[Ok]\033[0;37m" . PHP_EOL;
        } else {
            if (isset($this->db)) {
                echo 'ERROR ' . $this->db->getError('code').'. ';
                echo $this->db->getError('description') . PHP_EOL;
            }
            echo "\033[0;31m[FAIL]\033[0;37m" . PHP_EOL;
            $this->errors++;
        }
    }

    private function prepare() {
        return;
    }
    
    private function clear() {
        return $this->db->exec("DROP TABLE IF EXISTS " . $this->table);
    }

    private function connect() {
        echo $this->n++ . ". Connect" . PHP_EOL;
        try {
            $this->db = new PDODatabase([
                "type"=>"MySQL",
                "driver"=>"PDO",
                "servername"=>"localhost",
                "username"=>"test",
                "password"=>"test",
                "database"=>"test",
                "persistentConnection"=>true,
                "attributes"=>[
                    Database::ATTR_ERRMODE => Database::ERRMODE_EXCEPTION,
                    Database::ATTR_DEFAULT_FETCH_MODE => Database::FETCH_BOTH,
                ]
            ]);
        } catch (\Exception $e) {
            echo 'ERROR: '. $e->getMessage() . PHP_EOL;
            return false;
        }
        return true;
    }
    
    private function errorConnect() {
        echo $this->n++ . ". Connect with wrong password" . PHP_EOL;
        try {
            $db = new PDODatabase([
                "type"=>"MySQL",
                "driver"=>"PDO",
                "servername"=>"localhost",
                "username"=>"test",
                "password"=>"ERROR",
                "database"=>"test",
                "persistentConnection"=>true,
            ]);
        } catch (\Exception $e) {
            if ($e->getCode()===1045) {
                return true;
            } else {
                echo 'ERROR: catched error ' . $e->getCode() . ', but must be 1045. ';
                return false;
            }
        }
        echo 'ERROR: dont\'t catched exception! ';
        return false;
    }
    
    private function syntaxErrorWOBind() {
        echo $this->n++ . ". Syntax error without bind" . PHP_EOL;
        try {
            $this->db->exec("TEST SYNTAX ERROR WITHOUT BIND")->getStatus();
        } catch (\Exception $e) {
            if ($e->getCode()==='42000') {
                return true;
            } else {
                echo 'ERROR: catched error ' . $e->getCode() . ', but must be 1045.';
                return false;
            }
        }
        echo 'ERROR: dont\'t catched "Syntax error without bind" exception! ';
        return false;
    }
    
    private function syntaxErrorWBind() {
        echo $this->n++ . ". Syntax error with bind" . PHP_EOL;
        try {
            $this->db->exec("TEST SYNTAX ERROR WITH BIND")->getStatus();
        } catch (\Exception $e) {
            if ($e->getCode()==='42000') {
                return true;
            } else {
                echo 'ERROR: catched error ' . $e->getCode() . ', but must be 1045.';
                return false;
            }
        }
        echo 'ERROR: dont\'t catched "Syntax error with bind" exception! ';
        return false;
    }

    private function ddl() {
        echo $this->n++ . ". DDL operation" . PHP_EOL;
        return $this->db->exec(
            "CREATE TABLE " . $this->table . " ("
                . "id int(6) NOT NULL AUTO_INCREMENT, "
                . "number int(6), "
                . "string varchar(100), "
                . "PRIMARY KEY (id) )")->getStatus();
    }
    
    private function insert() {
        echo $this->n++ . ". Insert (test 'ddl' is requied)" . PHP_EOL;
        return $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (1,'text')")
            ->getStatus();
    }
    
    private function select() {
        echo $this->n++ . ". Select (test 'insert' is requied)" . PHP_EOL;
        $sample = [ 0 => [ 'id'=>"1", 0=>"1",
            'number'=>"1", 1=>"1",
            'string'=>"text", 2=>"text" ] ];
        $result = $this->db->exec(
            "SELECT * FROM " . $this->table . " WHERE number=1")->getAll();
        if ($result===$sample) {
            return true;
        } else {
            echo 'Sample and result are different:' . PHP_EOL;
            echo 'Sample:' . serialize($sample) . PHP_EOL;
            echo 'Result:' . serialize($result) . PHP_EOL;
            return false;
        }
    }
    
    private function insertWithBind() {
        echo $this->n++ . ". Insert with binding (test 'ddl' is requied)" . PHP_EOL;
        return $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (:num,:str)"
            ,["num"=>"2","str"=>"text2"])->getStatus();
    }
    
    /*private function getInsertId() {
        echo $this->n++ . ". Get id last inserted row (test 'insertWithBind' is requied)" . PHP_EOL;
        return ($this->db->lastInsertId()==2);
    }*/
    
    private function selectWithBind() {
        echo $this->n++ . ". Select with binding (test 'insertWithBind' is requied)" . PHP_EOL;
        $sample = [ 0 => [ 
            'id' => "2", 0 => "2",
            'number' => "2", 1 => "2",
            'string' => "text2", 2 => "text2" ] ];
        $result = $this->db->exec(
            "SELECT * FROM " . $this->table 
            . " WHERE number=:num or (number!=:num AND number=:num2)"
            ,['num'=>[2,'i'],'num2'=>[1234567890,'i']])->getAll();
        if ($result===$sample) {
            return true;
        } else {
            echo 'Sample and result are different:' . PHP_EOL;
            echo 'Sample:' . serialize($sample) . PHP_EOL;
            echo 'Result:' . serialize($result) . PHP_EOL;
            return false;
        }
    }
    
    private function selectArray() {
        echo $this->n++ . ". Select array (test 'insertWithBind' is requied)" . PHP_EOL;
        $sample = [ 
            0 => [
                'id' => "1", 0 => "1",
                'number' => "1", 1 => "1",
                'string' => "text", 2 => "text"
            ],
            1 => [
                'id' => "2", 0 => "2",
                'number' => "2", 1 => "2",
                'string' => "text2", 2 => "text2"
            ],
            2 => null,
        ];
        $data = $this->db->exec("SELECT * FROM " . $this->table 
            . " WHERE id IN (1,2) ORDER BY id");
        $result = [];
        $result[0] = $data->getArray();
        $result[1] = $data->getArray();
        $result[2] = $data->getArray();
        if ($result===$sample) {
            return true;
        } else {
            echo 'Sample and result are different:' . PHP_EOL;
            echo 'Sample:' . serialize($sample) . PHP_EOL;
            echo 'Result:' . serialize($result) . PHP_EOL;
            return false;
        }
    }
    
    private function selectScalar() {
        echo $this->n++ . ". Select scalar (test 'insertWithBind' is requied)" . PHP_EOL;
        $sample = ["text2",null];
        $data = $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=2");
        $result = [];
        $result[0] = $data->getScalar();
        $result[1] = $data->getScalar();
        if ($result===$sample) {
            return true;
        } else {
            echo 'Sample and result are different:' . PHP_EOL;
            echo 'Sample:' . serialize($sample) . PHP_EOL;
            echo 'Result:' . serialize($result) . PHP_EOL;
            return false;
        }
    }
    
    private function ddlError() {
        echo $this->n++ . ". DDL error operation (test 'ddl' is requied)" . PHP_EOL;
        try {
            $this->db->exec("CREATE TABLE " . $this->table . " (id int(6))");
        } catch (\Exception $e) {
            if ($e->getCode()==='42S01') {
                return true;
            } else {
                echo 'ERROR: catched error ' . $e->getCode() . ', but must be "42S01". ';
                return false;
            }
        }
        echo 'ERROR: dont\'t catched "DDL error operation" exception! ';
        return false;
    }
    
    private function transaction() {
        echo $this->n++ . ". Transactions" . PHP_EOL;
        if ( ! $this->db->transaction() ) {
            echo "Error in start transaction" . PHP_EOL;
            return false;
        };
        if ( ! $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (3,'transaction')")
            ->getStatus() ) {
            echo "Error while inserting" . PHP_EOL;
            return false;
        }
        $q = $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3");
        if ( ! $q->getStatus() ) {
            echo "Error while execute select" . PHP_EOL;
            return false;
        }
        if ( $q->getAll() !== [0=>['string'=>'transaction',0=>'transaction']] ) {
            echo "Error while fetch select result" . PHP_EOL;
            return false;
        }
        $this->db->rollback();
        if ( $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3")
            ->getAll() !== [] ) {
            echo "Error while select after rollback" . PHP_EOL;
            return false;
        }
        if ( ! $this->db->transaction() ) {
            echo "Error in second start transaction" . PHP_EOL;
            return false;
        };
        if ( ! $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (3,'transaction2')")
            ->getStatus() ) {
            echo "Error while second inserting" . PHP_EOL;
            return false;
        }
        $this->db->commit();
        if ( $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3")
            ->getAll() !== [0=>['string'=>'transaction2',0=>'transaction2']] ) {
            echo "Error while select after commit" . PHP_EOL;
            return false;
        }
        return true;
    }
    
    private function getAffectedRows() {
        echo $this->n++ . ". Get affected rows" . PHP_EOL;
        $this->db->exec("INSERT INTO " . $this->table 
            . " (number,string) VALUES (11,'text'),(12,'text'),(13,'text')");
        $rows = $this->db->getAffectedRows();
        if ($rows!==3) {
            echo "ERROR: insert 3 rows, getAffectedRows return {$rows}." . PHP_EOL;
            return false;
        }
        $this->db->exec("UPDATE " . $this->table 
            . " SET string='text2' WHERE number IN (:num1,:num2)"
            , ['num1'=>[11,'i'],'num2'=>[12,'i']]);
        $rows = $this->db->getAffectedRows();
        if ($rows!==2) {
            echo "ERROR: update 2 rows, getAffectedRows return {$rows}." . PHP_EOL;
            return false;
        }
        return true;
    }
}
