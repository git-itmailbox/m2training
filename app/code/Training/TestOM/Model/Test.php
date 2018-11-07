<?php

namespace Training\TestOM\Model;
class Test
{
	private $manager;
	private $arrayList;
	private $name;
	private $number;
	private $managerFactory;

	public function __construct(
		ManagerInterface $manager,
		$name,
		int $number,
		array $arrayList,
		\Training\TestOM\Model\ManagerInterfaceFactory $managerFactory
	) {
		$this->manager = $manager;
		$this->name = $name;
		$this->number = $number;
		$this->arrayList = $arrayList;
		$this->managerFactory = $managerFactory;

	}

	public function log()
	{
//		var_dump($this->manager);
		print_r(get_class($this->manager));
		echo '<br>';
		print_r($this->name);
		echo '<br>';
		print_r($this->number);
		echo '<br>';
		print_r($this->arrayList);
		echo '<br>';
		$newManager = $this->managerFactory->create();
//		var_dump($newManager);
		print_r(get_class($newManager));

		echo '<br>';
		echo '=====================================';
		echo '<br>';
		echo '<br>';

	}
}