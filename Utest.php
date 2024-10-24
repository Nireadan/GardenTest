<?php

use PHPUnit\Framework\TestCase;
require 'main.php';

class Utest extends TestCase
{
    public function testAppleTreeCreation()
    {
        $appleTree = new apple_tree(1);
        $this->assertLessThanOrEqual(50, count($appleTree->getFruits()));
        $this->assertEquals('A1', $appleTree->mark);
    }

    public function testPearTreeCreation()
    {
        $pearTree = new pear_tree(1);
        $this->assertLessThanOrEqual(20, count($pearTree->getFruits()));
        $this->assertEquals('P1', $pearTree->mark);
    }

    public function testGardenCreation()
    {
        $garden = new garden(10, 15);
        $this->assertCount(25, $garden->trees);
    }

    public function testGetFruitCount()
    {
        $garden = new garden(10, 15);
        $appleCount = $garden->get_fruit_count(apple_tree::class);
        $pearCount = $garden->get_fruit_count(pear_tree::class);

        $this->assertLessThanOrEqual(500, $appleCount);
        $this->assertLessThanOrEqual(300, $pearCount);
    }
	
	public function testFruitsWeight() {
		$garden = new garden(10, 15);
		
		foreach ($garden->trees as $tree) {
            if ($tree instanceof apple_tree) {
				foreach ($tree->getFruits() as $apple) {
					$this->assertGreaterThan(149, $apple->getWeight());
					$this->assertLessThanOrEqual(180, $apple->getWeight());
				}
			}
			
			if ($tree instanceof pear_tree) {
				foreach ($tree->getFruits() as $pear) {
					$this->assertGreaterThan(129, $pear->getWeight());
					$this->assertLessThanOrEqual(170, $pear->getWeight());
				}
			}
		}
	}

    public function testGetTotalWeight()
    {
        $garden = new garden(10, 15);
        $totalWeightApples = $garden->get_total_weight(apple_tree::class);
        $totalWeightPears = $garden->get_total_weight(pear_tree::class);

        $this->assertGreaterThan(0, $totalWeightApples);
        $this->assertGreaterThan(0, $totalWeightPears);
    }

    public function testGetHeaviestApple()
    {
        $garden = new garden(10, 15);
        $heaviestApple = $garden->get_heaviest_apple();

        $this->assertNotNull($heaviestApple);
        $this->assertGreaterThan(0, $heaviestApple->getWeight());
    }
}