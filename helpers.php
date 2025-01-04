<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 * @param string $name
 * @param void just load a file
 */

function loadView($name)
{

    $viewPath = basePath("views/{$name}.view.php");
    if (file_exists($viewPath)) {
        // require basePath("views/{$name}.view.php");
        require $viewPath;
    } else {
        echo "view {$name} not found ";
    }
}

function loadPartials($name)
{
    // require basePath("views/partials/{$name}.php");
    $partialPath = basePath("views/partials/{$name}.php");;
    if (file_exists($partialPath)) {
        // require basePath("views/{$name}.view.php");
        require $partialPath;
    } else {
        echo "Partial {$name} not found ";
    }
}
