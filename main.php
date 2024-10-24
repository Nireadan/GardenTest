<?php

class tree {
	protected $mark;
    protected $fruits = [];


    public function getFruits() {
        return $this->fruits;
    }
}

class fruit {
	protected $weight;
	protected $marking;
	
	public function getWeight() {
        return $this->weight;
    }
	
	public function getMarking() {
        return $this->marking;
    }
}

class apple_fruit extends fruit {
	
	public function __construct($mark = '0') {
		$this->weight = rand(150, 180);
		$this->marking = $mark;
	}
}

class pear_fruit extends fruit {
	
	public function __construct($mark = '0') {
		$this->weight = rand(130, 170);
		$this->marking = $mark;
	}
}

class apple_tree extends tree {
	
    public function __construct($mark = 0) {
		$amount_fruit = rand(40, 50);
		$this->mark = 'A' . $mark;
		
		for ($i = 0; $i < $amount_fruit; $i++){
			$this->fruits[] = new apple_fruit($this->mark);
		}
	}
}

class pear_tree extends tree {

	public function __construct($mark = 0) {
		$amount_fruit = rand(0, 20);
		$this->mark = 'P' . $mark;
		
		for ($i = 0; $i < $amount_fruit; $i++){
			$this->fruits[] = new pear_fruit($this->mark);
		}
	}
}

class garden{
	
	public $trees = [];
	
	public function __construct($at_count = 0, $pt_count = 0) {
		for ($i = 0; $i < $at_count; $i++){
		   $this->trees[] = new apple_tree($i);
		}

		for ($i = 0; $i < $pt_count; $i++){
		   $this->trees[] = new pear_tree($i);
		}
	}
	
	public function get_fruit_count($ftype) {
        $count = 0;
        foreach ($this->trees as $tree) {
            if ($tree instanceof $ftype) {
                $count += count($tree->getFruits());
            }
        }
        return $count;
    }

    public function get_total_weight($ftype) {
        $weight = 0;
        foreach ($this->trees as $tree) {
            if ($tree instanceof $ftype) {
                foreach ($tree->getFruits() as $fruit) {
                    $weight += $fruit->getWeight();
                }
            }
        }
        return $weight;
    }

    public function get_heaviest_apple() {
        $heaviest = null;
        foreach ($this->trees as $tree) {
            if ($tree instanceof apple_tree) {
                foreach ($tree->getFruits() as $apple) {
					if ($heaviest === null) 
						$heaviest = $apple;
					else if ($apple->getWeight() > $heaviest->getWeight()) {
                        $heaviest = $apple;
                    }
                }
            }
        }
        return $heaviest;
    }
}

$garden = new garden(10, 15);

echo "Всего деревьев: " . count($garden->trees) . "<br>";
echo "Собрано яблок: " . $garden->get_fruit_count(apple_tree::class) . "<br>";
echo "Собрано груш: " . $garden->get_fruit_count(pear_tree::class) . "<br>";
echo "Общий вес яблок: " . $garden->get_total_weight(apple_tree::class) . " гр<br>";
echo "Общий вес груш: " . $garden->get_total_weight(pear_tree::class) . " гр<br>";

$heaviestApple = $garden->get_heaviest_apple();
echo "Вес самого тяжелого яблока: " . ($heaviestApple ? $heaviestApple->getMarking() . ' - ' .  $heaviestApple->getWeight() : "Не найдено") . " гр<br>";