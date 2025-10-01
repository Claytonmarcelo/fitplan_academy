<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Test Case Base
 * 
 * Classe base para todos os testes da aplicação.
 * Fornece funcionalidades comuns para testes.
 * 
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}

