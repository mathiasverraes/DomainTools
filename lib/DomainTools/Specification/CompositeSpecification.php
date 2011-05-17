<?php
namespace DomainTools\Specification;

/**
 * Works like AndSpecification, only here you can pass an unlimited amount of
 * Specifications in the constructor
 */
class CompositeSpecification extends AbstractSpecification implements Specification
{
	private $specifications = array();

	public function __construct()
	{
		foreach(func_get_args() as $specification)
		{
			if(!($specification instanceof Specification)) {
				throw new \InvalidArgumentException('DomainTools\Specification\Specification expected');
			}
			$this->specifications[] = $specification;
		}
	}

	public function isSatisfiedBy($object)
	{
		foreach($this->specifications as $specification)
		{
			if(!$specification->isSatisfiedBy($object)) {
				return false;
			}
			return true;
		}
	}
}