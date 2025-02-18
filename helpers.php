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

function loadView($name, $data = [])
{

    $viewPath = basePath("App/views/{$name}.view.php");
    if (file_exists($viewPath)) {
        extract($data);
        // require basePath("views/{$name}.view.php");
        require $viewPath;
    } else {
        echo "view {$name} not found ";
    }

    // inspect($viewPath);
}



function loadPartials($name, $data =[])
{
    // require basePath("views/partials/{$name}.php");
    $partialPath = basePath("App/views/partials/{$name}.php");;
    if (file_exists($partialPath)) {
        extract($data);
        // require basePath("views/{$name}.view.php");
        require $partialPath;
    } else {
        echo "Partial {$name} not found ";
    }
}

/**
 * Inspect a value(s)
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";
}



/**
 * Inspect a value(s) and die
 * @param mixed $value
 * @return void
 */

function inspectAndDie($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";
    die();
}

/**
 * Format Salary
 * @return string $Salary
 */

function formatSalary($salary)
{
    return '$' . number_format($salary, 2, '.', ',');
}


/**
 * Sanitize users data
 * @params string $dirty
 * @return string
 */

function sanitize($dirty)
{
    return  filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given url
 * @params string $url
 * @return void 
 */

function redirect($url)
{
    header("Location: {$url}");
    exit;
}


