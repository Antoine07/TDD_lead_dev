<?php
// Framework de tests PHPUNIT

use App\Message;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Message $message;
    protected array $m = [];

    public function setUp():void{
        $this->message = new Message(lang : $_ENV['TRANSLATE'] ?? 'en');
    }

    public function testMessage(){
        $this->assertEquals('fr', (string) $this->message);
    }

    public function testLanguagesDef(){
        $this->assertContains($_ENV['TRANSLATE'], ['en', 'fr'])
    }

    public function testTranslate(){
        $this->message->setLang('fr');
        $this->assertEquals('Bonjour tout le monde', $this->message->getTranslate());
        $this->message->setLang('en');
        $this->assertEquals('Hello World', $this->message->getTranslate());
    }
}