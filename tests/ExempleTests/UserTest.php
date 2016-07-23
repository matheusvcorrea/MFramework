<?php

namespace ExampleTests;

use PHPUnit_Framework_TestCase;
use Example\User;

class UserTest extends PHPUnit_Framework_TestCase
{
	/**
	* @test
	*/
	public function defineEObtemONome()
	{
		$user = new User("Marcelo", "Jacobus");

		$this->assertEquals("Marcelo", $user->getName());	
	}

	/**
	* @test
	*/
	public function defineEObtemOSobreNome()
	{
		$user = new User("Marcelo", "Jacobus");

		$this->assertEquals("Jacobus", $user->getLastName());
	}

	/**
	* @test
	*/
	public function nomeCompletoEhAConcatenacaoDoNomeESobreNome()
	{
		$user = new User("Marcelo", "Jacobus");

		$expected = "Marcelo Jacobus";

		$actual = $user->getCompleteName();

		$this->assertEquals($expected, $actual);
	}
}