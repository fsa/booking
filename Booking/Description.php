<?php
namespace Booking;

class Description
{
    private $text;
    private $result;
    public static $error_format=0;
    public static $param_names=[];

    public function __construct($text)
    {
        $this->text=$text;
        $this->parseText();
    }

    public function get()
    {
        return $this->result;
    }

    private function parseText()
    {
        $result = ['debug' => $this->text];
        $parts = explode("\n", $this->text);
        foreach ($parts as $part) {
            $p = explode(':', $part, 2);
            if (sizeof($p)==2) {
                $name = trim($p[0]);
                $value = trim($p[1]);
                self::$param_names[$name] = true;
            }
            else {
                self::$error_format++;
            }
        }
        $this->result=$result;
    }
}