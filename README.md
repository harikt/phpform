Standalone Form for PHP
=======================

The minimal stuff you need to create and validate your form. If you want to
use a powerful validation and filtering use something like [Aura.Filter][] 
or your favourite component that does it. You can see how you can do it
in the example in master branch.

The `composer.json` file

```php
{
    "require": {
        "aura/input": ">=1.0.0, <=2.0.0",
        "aura/html": "2.0.*"
    }
}
```

The page which you need to bring the form.

```php
use Aura\Input\Builder;
use Aura\Input\Filter;
use Aura\Input\Form;
use Aura\Html\HelperLocatorFactory;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
```

## Creating your Form class

To create your form extend the class with Aura\Input\Form . 
Here is an example of contact form with fields name, email, url and message in it.

```php
class ContactForm extends Form
{
    public function init()
    {
        $this->setField('name')
            ->setAttribs([
                'id' => 'contact[name]',
                'name' => 'contact[name]',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('email')
            ->setAttribs([
                'id' => 'contact[email]',
                'name' => 'contact[email]',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('url')
            ->setAttribs([
                'id' => 'contact[url]',
                'name' => 'contact[url]',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('message', 'textarea')
            ->setAttribs([
                'id' => 'contact[message]',
                'name' => 'contact[message]',
                'cols' => 40,
                'rows' => 5,
            ]);
        $this->setField('submit', 'submit')
            ->setAttribs(['value' => 'send']);

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
```

Now create the object of Form passing the `Aura\Input\Builder` object and 
object of type `Aura\Input\FilterInterface`.
As we are using the base filter of Aura.Input pass `Aura\Input\Filter`.

```php
$form = new ContactForm(new Builder(), new Filter());

if (isset($_POST['submit']) && $_POST['submit'] == 'send') {    
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
```
