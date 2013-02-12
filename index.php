<?php
use Aura\Input\FieldCollection;
use Aura\Input\FieldFactory;

use Aura\Filter\RuleCollection;
use Aura\Filter\RuleLocator;
use Aura\Filter\Translator;

$loader = require 'vendor/autoload.php';
$loader->add('Domicile\Example', __DIR__ . '/lib');

// I am lazy lets load via the instance
$filter = new Domicile\Example\Filter(
    new RuleLocator([
        'alnum'                 => function() { return new \Aura\Filter\Rule\Alnum; },
        'alpha'                 => function() { return new \Aura\Filter\Rule\Alpha; },
        'between'               => function() { return new \Aura\Filter\Rule\Between; },
        'blank'                 => function() { return new \Aura\Filter\Rule\Blank; },
        'bool'                  => function() { return new \Aura\Filter\Rule\Bool; },
        'creditCard'            => function() { return new \Aura\Filter\Rule\CreditCard; },
        'dateTime'              => function() { return new \Aura\Filter\Rule\DateTime; },
        'email'                 => function() { return new \Aura\Filter\Rule\Email; },
        'equalToField'          => function() { return new \Aura\Filter\Rule\EqualToField; },
        'equalToValue'          => function() { return new \Aura\Filter\Rule\EqualToValue; },
        'float'                 => function() { return new \Aura\Filter\Rule\Float; },
        'inKeys'                => function() { return new \Aura\Filter\Rule\InKeys; },
        'int'                   => function() { return new \Aura\Filter\Rule\Int; },
        'inValues'              => function() { return new \Aura\Filter\Rule\InValues; },
        'ipv4'                  => function() { return new \Aura\Filter\Rule\Ipv4; },
        'max'                   => function() { return new \Aura\Filter\Rule\Max; },
        'min'                   => function() { return new \Aura\Filter\Rule\Min; },
        'regex'                 => function() { return new \Aura\Filter\Rule\Regex; },
        'strictEqualToField'    => function() { return new \Aura\Filter\Rule\StrictEqualToField; },
        'strictEqualToValue'    => function() { return new \Aura\Filter\Rule\StrictEqualToValue; },
        'string'                => function() { return new \Aura\Filter\Rule\String; },
        'strlenBetween'         => function() { return new \Aura\Filter\Rule\StrlenBetween; },
        'strlenMax'             => function() { return new \Aura\Filter\Rule\StrlenMax; },
        'strlenMin'             => function() { return new \Aura\Filter\Rule\StrlenMin; },
        'strlen'                => function() { return new \Aura\Filter\Rule\Strlen; },
        'trim'                  => function() { return new \Aura\Filter\Rule\Trim; },
        'upload'                => function() { return new \Aura\Filter\Rule\Upload; },
        'url'                   => function() { return new \Aura\Filter\Rule\Url; },
        'word'                  => function() { return new \Aura\Filter\Rule\Word; },
        'any'                   => function() {
            // the 'any' rule needs its own rule locator
            $rule = new \Aura\Filter\Rule\Any;
            $rule->setRuleLocator(new \Aura\Filter\RuleLocator([
                'alnum'                 => function() { return new \Aura\Filter\Rule\Alnum; },
                'alpha'                 => function() { return new \Aura\Filter\Rule\Alpha; },
                'between'               => function() { return new \Aura\Filter\Rule\Between; },
                'blank'                 => function() { return new \Aura\Filter\Rule\Blank; },
                'bool'                  => function() { return new \Aura\Filter\Rule\Bool; },
                'creditCard'            => function() { return new \Aura\Filter\Rule\CreditCard; },
                'dateTime'              => function() { return new \Aura\Filter\Rule\DateTime; },
                'email'                 => function() { return new \Aura\Filter\Rule\Email; },
                'equalToField'          => function() { return new \Aura\Filter\Rule\EqualToField; },
                'equalToValue'          => function() { return new \Aura\Filter\Rule\EqualToValue; },
                'float'                 => function() { return new \Aura\Filter\Rule\Float; },
                'inKeys'                => function() { return new \Aura\Filter\Rule\InKeys; },
                'int'                   => function() { return new \Aura\Filter\Rule\Int; },
                'inValues'              => function() { return new \Aura\Filter\Rule\InValues; },
                'ipv4'                  => function() { return new \Aura\Filter\Rule\Ipv4; },
                'max'                   => function() { return new \Aura\Filter\Rule\Max; },
                'min'                   => function() { return new \Aura\Filter\Rule\Min; },
                'regex'                 => function() { return new \Aura\Filter\Rule\Regex; },
                'strictEqualToField'    => function() { return new \Aura\Filter\Rule\StrictEqualToField; },
                'strictEqualToValue'    => function() { return new \Aura\Filter\Rule\StrictEqualToValue; },
                'string'                => function() { return new \Aura\Filter\Rule\String; },
                'strlenBetween'         => function() { return new \Aura\Filter\Rule\StrlenBetween; },
                'strlenMax'             => function() { return new \Aura\Filter\Rule\StrlenMax; },
                'strlenMin'             => function() { return new \Aura\Filter\Rule\StrlenMin; },
                'strlen'                => function() { return new \Aura\Filter\Rule\Strlen; },
                'trim'                  => function() { return new \Aura\Filter\Rule\Trim; },
                'upload'                => function() { return new \Aura\Filter\Rule\Upload; },
                'url'                   => function() { return new \Aura\Filter\Rule\Url; },
                'word'                  => function() { return new \Aura\Filter\Rule\Word; },
            ]));
            return $rule;
        },
    ]),
    new Translator(require __DIR__ . '/vendor/aura/filter/intl/en_US.php')
);

$form = new Domicile\Example\ContactForm(new FieldCollection(new FieldFactory), $filter);

$template = require __DIR__ . '/vendor/aura/view/scripts/instance.php';

if ($_POST && $_POST['submit'] == 'send') {
    $form->setValues($_POST);
    if ($form->filter()) {
        $data = $form->getValues();
        // Do what you need
    }
}

// $form->setValues($post);
$finder = $template->getTemplateFinder();
// set the paths where templates can be found
$finder->setPaths([
    __DIR__ .'/templates',
]);

$template->addData([
    'form' => $form,
    'title' => 'Demonstrate Aura Form',
]);

echo $template->fetch('default.php');
