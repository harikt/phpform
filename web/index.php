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

if ($_POST && $_POST['submit'] == 'send') {
    $data = $_POST;
    $form->fill($data);
    if ($form->filter()) {
        //
        echo "Yes successfully validated and filtered";
        var_dump($data);
        exit;
    }
}

$helper = new Aura\View\HelperLocator([
    'field'         => function () { 
        return new Aura\View\Helper\Form\Field(
            require dirname(__DIR__) . '/vendor/aura/view/scripts/field_registry.php'
        ); 
    },
    'input'         => function () { return new Aura\View\Helper\Form\Input(
            require dirname(__DIR__) . '/vendor/aura/view/scripts/input_registry.php'
        ); 
    },
    'radios'        => function () { return new Aura\View\Helper\Form\Radios(new Aura\View\Helper\Form\Input\Checked); },
    'repeat'         => function () { return new Aura\View\Helper\Form\Repeat(
            require dirname(__DIR__) . '/vendor/aura/view/scripts/repeat_registry.php'
        ); 
    },
    'select'        => function () { return new Aura\View\Helper\Form\Select; },
    'textarea'      => function () { return new Aura\View\Helper\Form\Textarea; },
]);

$field = $helper->get('field');
?>
<html>
<head>
    <title>Aura Form, to make it standalone</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>Name : </td>
                <td>
                <?php
                    echo $field($form->get('name'));
                    $name = 'name';
                    include dirname(__DIR__) . '/templates/_field.php';
                ?>
                </td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>
                <?php
                    echo $field($form->get('email'));
                    $name = 'email';
                    include dirname(__DIR__) . '/templates/_field.php';
                ?>
                </td>
            </tr>
            <tr>
                <td>Url : </td>
                <td>
                <?php
                    echo $field($form->get('url'));
                    $name = 'url';
                    include dirname(__DIR__) . '/templates/_field.php';
                ?>
                </td>
            </tr>
            <tr>
                <td>Message : </td>
                <td>
                <?php
                    echo $field($form->get('message'));
                    $name = 'message';
                    include dirname(__DIR__) . '/templates/_field.php';
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php 
                echo $field($form->get('submit'));
                ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
