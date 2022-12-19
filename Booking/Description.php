<?php
namespace Booking;

use Exception;

class Description
{
    private $text;
    private $result;
    public static $error_format=0;

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
        $result = ['error'=>[]];
        $parts = explode("\n", $this->text);
        foreach ($parts as $part) {
            $p = explode(':', $part, 2);
            if (count($p)==2) {
                $name = trim($p[0]);
                $value = trim($p[1]);
                switch ($name) {
                    case "Имя":
                        $result['name'] = $value;
                        break;
                    case "Телефон":
                        $result['phone'] = $value;
                        break;
                    case "Взрослых":
                        $result['adults'] = $value;
                        break;
                    case "Детей":
                        $result['kids'] = $value;
                        break;
                    case "Людей":
                        $result['body'] = $value;
                        break;
                    case "Гости":
                        $result['guests'] = $value;
                        break;
                    case "Цена":
                        $result['price'] = $value;
                        break;
                    case "Оплата":
                        $result['paid'] = $value;
                        break;
                    case "Предоплата":
                        $result['prepaid'] = $value;
                        break;
                    case "Транспорт":
                        $result['transport'] = $value;
                        break;
                    case "E-mail":
                        $result['email'] = $value;
                        break;
                    default:
                        $result['error'][] = $part;
                }
            }
            else {
                $result['error'][] = $part;
            }
        }
        $this->result=$result;
    }
}