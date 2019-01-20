<?php

namespace app\fixtures;

/**
 * Fixture
 *
 * @author Ivan Kuchukov <ivan.kuchukov@gmail.com>
 */
class fixtureUsers {
    
    public function load() {
        $this->db->exec("INSERT INTO users (login) VALUES ('user1'),('user2')");
        return true;
    }
    
    public function clear() {
        $this->db->exec("DELETE FROM users");
        return true;
    }
}
