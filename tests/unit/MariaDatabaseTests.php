<?php

namespace app\tests\unit;
use trivial\models\MariaDatabase;
use trivial\controllers\App;

/**
 * Tests for MariaDatabase class
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class MariaDatabaseTests {
    private $db;
    private $n=1;
    private $table="test56365464";

    /**
     * run tests
     * @return boolean
     */
    public function run() {
        $con = $this->connect();
        $this->validate($con);
        if ($con) {
            $this->db->setErrorMode('ignore');
            $this->clear();
            $this->db->setErrorMode('debug');
            $this->prepare();
            $this->validate($this->ddl());
            $this->validate($this->insert());
            $this->validate($this->select());
            $this->validate($this->insertWithBind());
            $this->validate($this->getInsertId());
            $this->validate($this->selectWithBind());
            $this->validate($this->selectArray());
            $this->validate($this->selectScalar());
            $this->validate($this->transaction());
            $this->db->setErrorMode('ignore');
            $this->validate($this->ddlError());
            $this->db->setErrorMode('debug');
            $this->clear();
            echo 'Done!' . PHP_EOL;
        } else {
            echo 'Connection fail!' . PHP_EOL;
        }
    }
    
    private function validate($test) {
        if ( $test ) {
            echo "\033[0;32m[Ok]\033[0;37m" . PHP_EOL;
        } else {
            echo "\033[0;31m[FAIL]\033[0;37m" . PHP_EOL;
        }
    }

    private function prepare() {
        return;
    }
    
    public function clear() {
        return $this->db->exec("DROP TABLE " . $this->table);
    }

    private function connect() {
        echo $this->n++ . ". Connect" . PHP_EOL;
        $this->db = new MariaDatabase(App::params("db"));
        $error = $this->db->getError('code');
        return ($error===0) ? true : false;
    }

    private function ddl() {
        echo $this->n++ . ". DDL operation" . PHP_EOL;
        return $this->db->exec(
            "CREATE TABLE " . $this->table . " ("
                . "id int(6) NOT NULL AUTO_INCREMENT, "
                . "number int(6), "
                . "string varchar(100), "
                . "PRIMARY KEY (id) )")->getResult();
    }
    
    private function insert() {
        echo $this->n++ . ". Insert (test 'ddl' is requied)" . PHP_EOL;
        return $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (1,'text')")
            ->getResult();
    }
    
    private function select() {
        echo $this->n++ . ". Select (test 'insert' is requied)" . PHP_EOL;
        $sample = [ 0 => [ 'id' => "1", 'number' => "1", 'string' => "text" ] ];
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
            "INSERT INTO " . $this->table . " (number,string) VALUES (?,?)"
            ,[[2,"i"],"text2"])->getResult();
    }
    
    private function getInsertId() {
        echo $this->n++ . ". Get id last inserted row (test 'insertWithBind' is requied)" . PHP_EOL;
        return ($this->db->getInsertId()==2);
    }
    
    private function selectWithBind() {
        echo $this->n++ . ". Select with binding (test 'insertWithBind' is requied)" . PHP_EOL;
        $sample = [ 0 => [ 'id' => 2, 'number' => 2, 'string' => "text2" ] ];
        $result = $this->db->exec(
            "SELECT * FROM " . $this->table . " where number=?",[[2,'i']])->getAll();
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
        $sample = [ 'id' => "2", 'number' => "2", 'string' => "text2" ];
        $result = $this->db->exec(
            "SELECT * FROM " . $this->table . " where number=2")->getArray();
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
        $sample = "text2";
        $result = $this->db->exec("SELECT string FROM " . $this->table . " where number=2")->getScalar();
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
        $error = $this->db->exec(
            "CREATE TABLE " . $this->table . " (id int(6))")->getError();
        if ($error['code']===1050) {
            return true;
        } else {
            echo "Sample: [1050] Table '" . $this->table . "' already exists" . PHP_EOL;
            echo "Result: [" . $error['code'] . "] " . $error['description'] . PHP_EOL;
            return false;
        }
    }
    
    private function transaction() {
        echo $this->n++ . ". Transactions" . PHP_EOL;
        if ( ! $this->db->transaction() ) {
            return false;
        };
        if ( ! $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (3,'transaction')")
            ->getResult() ) {
            return false;
        }
        $q = $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3");
        if ( ! $q->getResult() ) {
            return false;
        }
        if ( $q->getAll() !== [0=>['string'=>'transaction']] ) {
            return false;
        }
        $this->db->rollback();
        if ( $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3")
            ->getAll() !== [] ) {
            return false;
        }
        if ( ! $this->db->transaction() ) {
            return false;
        };
        if ( ! $this->db->exec(
            "INSERT INTO " . $this->table . " (number,string) VALUES (3,'transaction2')")
            ->getResult() ) {
            return false;
        }
        $this->db->commit();
        if ( $this->db->exec("SELECT string FROM " . $this->table . " WHERE number=3")
            ->getAll() !== [0=>['string'=>'transaction2']] ) {
            return false;
        }
        return true;
    }
    
}