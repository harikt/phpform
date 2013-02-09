<?php
use Aura\Input\FieldCollection;
use Aura\Input\FieldFactory;

$loader = require 'vendor/autoload.php';
$loader->add('Domicile\Example', __DIR__ . '/lib');

$form = new Domicile\Example\Input\ContactForm(new FieldCollection(new FieldFactory));
// I am lazy lets load via the instance
$filter   = require __DIR__ . '/vendor/aura/filter/scripts/instance.php';
$template = require __DIR__ . '/vendor/aura/view/scripts/instance.php';

$form->setFilter($filter);

if ($_POST && $_POST['submit'] == 'submit') {
    echo "exit";
    $form->setValues($_POST);
    $form->filter();
}

// $form->setValues($post);
$finder = $template->getTemplateFinder();
// set the paths where templates can be found
$finder->setPaths([
    __DIR__ .'/templates',
]);

$template->addData([
    'form' => $form,
    'title' => 'Demonstrate Aura Form'
]);

echo $template->fetch('default.php');
