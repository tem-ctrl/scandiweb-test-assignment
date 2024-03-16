<?php

namespace App\Routes;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Router
{
  public static function get(string $filename, array $data): void
  {
    $views = dirname(__DIR__) . '/views';
    $cache = dirname(__DIR__) . '/cache';
    $loader = new FilesystemLoader($views);
    $twig = new Environment($loader, ['cache' => $cache, 'debug' => true, 'auto_escape' => 'html']);
    echo $twig->render($filename, $data);
  }
}
