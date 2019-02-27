<?php


namespace app\tests\unit;
use trivial\models\HtmlHelper;


class HtmlHelperTests
{
    /**
     * run tests
     * @return boolean
     */
    public function run() {
        $this->clear();
        $this->prepare();
        $this->validate($this->pagination());
        $this->clear();
        echo 'Done!' . PHP_EOL;
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

    private function clear() {
        return;
    }

    private function pagination() {
        $tests = require 'data' . DIR_SEP . 'HtmlHelperTestsPagination.php';
        foreach ($tests as $num=>$test) {
            echo '.';
            $result = HtmlHelper::getPagination($test['input']);
            if ( $result !== $test['output']) {
                echo PHP_EOL . "Test #" . ($num+1) . ":" . PHP_EOL;
                echo "Input:    " . json_encode($test['input']) . PHP_EOL;
                echo "Expected: " . json_encode($test['output']) . PHP_EOL;
                echo "Result:   " . json_encode($result) . PHP_EOL;
                return false;
            };
        }
        echo PHP_EOL;
        return true;
    }

}