<?php

namespace app\migrations;

/**
 * Migration for create tables
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class migration181216090800 {
    
    public function up() {
        return $this->db->exec("CREATE TABLE users ("
            . "id int(6) NOT NULL AUTO_INCREMENT, "
            . "login varchar(4000), "
            . "PRIMARY KEY (id) )")->getResult();
    }
    
    public function down() {
        return $this->db->exec("DROP TABLE users")->getResult();
    }
}
