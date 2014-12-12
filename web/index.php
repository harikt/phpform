<?php
/*
 *
 * @licence MIT
 *
 * @author Hari K T
 *
 */
use Aura\Input\Builder;
use Aura\Input\Filter;
use Aura\Input\Form;
use Aura\Html\HelperLocatorFactory;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

class ContactForm extends Form
{
    public function init()
    {
        $this->setName('contact');

        $this->setField('name')
            ->setAttribs([
                'id' => 'name',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('email')
            ->setAttribs([
                'id' => 'email',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('url')
            ->setAttribs([
                'id' => 'url',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('message', 'textarea')
            ->setAttribs([
                'id' => 'message',
                'cols' => 40,
                'rows' => 5,
            ]);
        $this->setField('submit', 'submit')
            ->setAttribs([
                'id' => 'send',
                'value' => 'send',
            ]);

        $filter = $this->getFilter();

        $filter->setRule(
            'name',
            'Name must be alphabetic only.',
            function ($value) {
                return ctype_alpha($value);
            }
        );

        $filter->setRule(
            'email',
            'Enter a valid email address',
            function ($value) {
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            }
        );

        $filter->setRule(
            'url',
            'Enter a valid url',
            function ($value) {
                return filter_var($value, FILTER_VALIDATE_URL);
            }
        );

        $filter->setRule(
            'message',
            'Message should be more than 7 characters',
            function ($value) {
                if (strlen($value) > 7) {
                    return true;
                }
                return false;
            }
        );
    }
}

$form = new ContactForm(new Builder(), new Filter());

if (isset($_POST['contact']['submit']) && $_POST['contact']['submit'] == 'send') {
    $data = $_POST['contact'];
    $form->fill($data);
    if ($form->filter()) {
        echo "Yes successfully validated and filtered";
        var_dump($data);
        exit;
    }
}

$factory = new HelperLocatorFactory();
$helper = $factory->newInstance();

function showFieldErrors($form, $name) {
    $errors = $form->getMessages($name);
    $str = '';
    if ($errors) {
        $str .= '<ul>';
        foreach ($errors as $error) {
            $str .= '<li>' . $error . '</li>';
        }
        $str .= '</ul>';
    }
    return $str;
}
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
                    echo $helper->input($form->get('name'));
                    echo showFieldErrors($form, 'name');
                ?>
                </td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>
                <?php
                    echo $helper->input($form->get('email'));
                    echo showFieldErrors($form, 'email');
                ?>
                </td>
            </tr>
            <tr>
                <td>Url : </td>
                <td>
                <?php
                    echo $helper->input($form->get('url'));
                    echo showFieldErrors($form, 'url');
                ?>
                </td>
            </tr>
            <tr>
                <td>Message : </td>
                <td>
                <?php
                    echo $helper->input($form->get('message'));
                    echo showFieldErrors($form, 'message');
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php
                echo $helper->input($form->get('submit'));
                ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
