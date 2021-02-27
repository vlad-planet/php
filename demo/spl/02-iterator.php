<pre>
<?php
class MyIterator implements Iterator{
    private $var = array();

    public function __construct($array){
        if (is_array($array)) {
            $this->var = $array;
        }
    }

    public function rewind() {
        echo "rewinding\n";
        reset($this->var);
    }

    public function current() {
        $var = current($this->var);
        echo "current: $var\n";
        return $var;
    }

    public function key() {
        $var = key($this->var);
        echo "key: $var\n";
        return $var;
    }

    public function next() {
        $var = next($this->var);
        echo "next: $var\n";
        return $var;
    }

    public function valid() {
        $var = $this->current() !== false;
        echo "valid: {$var}\n";
        return $var;
    }
}

$values = array(1,2,3);
$it = new MyIterator($values);

foreach ($it as $a => $b) {
    print "$a: $b\n";
}

echo '<hr>';

class NumberSquared implements Iterator{
    private $_start, $_end, $_cur;

    public function __construct($s, $e){
		$this->_start = $s;
		$this->_end = $e;
    }

    public function rewind() {
		$this->_cur = $this->_start;
    }

	public function key() {
        return $this->_cur;
    }
	
    public function current() {
        return pow($this->_cur, 2);
    }

    public function next() {
        return $this->_cur++;
    }

    public function valid() {
        return $this->_cur <= $this->_end;
    }
}

$nums = new NumberSquared(2, 7);

foreach ($nums as $a => $b) {
    print "Квадрат числа $a = $b\n";
}
?>