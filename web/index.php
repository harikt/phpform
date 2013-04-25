<?php
use Aura\Input\Builder;

use Aura\Filter\RuleLocator;
use Aura\Filter\Translator;

$rootpath = dirname( __DIR__ );
$templatesPath = [$rootpath .'/templates'];

$loader = require $rootpath . '/vendor/autoload.php';
$loader->add('Domicile\Example', $rootpath . '/lib');

// I am lazy lets load via the instance
$filter = new Domicile\Example\Filter(
    new RuleLocator(array_merge(
        require $rootpath . '/vendor/aura/filter/scripts/registry.php',
        ['any' => function () {
            $rule = new \Aura\Filter\Rule\Any;
            $rule->setRuleLocator(new RuleLocator(
                require $rootpath . '/vendor/aura/filter/scripts/registry.php'
            ));
            return $rule;
        }]
    )),
    new Translator(require $rootpath . '/vendor/aura/filter/intl/en_US.php')
);

$form = new Domicile\Example\ContactForm(new Builder, $filter);

$template = require $rootpath . '/vendor/aura/view/scripts/instance.php';

if ($_POST && $_POST['submit'] == 'send') {
    $form->fill($_POST);
    if ($form->filter()) {
        // do what you need
        var_dump($data);
        exit;
    }
}

// $form->setValues($post);
$finder = $template->getTemplateFinder();
// set the paths where templates can be found
$finder->setPaths($templatesPath);

$template->addData([
    'form' => $form,
    'title' => 'Demonstrate Aura Form',
]);

echo $template->fetch('default.php');
