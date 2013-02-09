<html>
<head>
    <title><?php echo $this->title; ?></title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
        <table cellpadding="0" cellspacing="0">
<?php
    $fields = $this->__raw()->form->getFields();
    $labels = array(
        'name' => 'Your name',
        'email' => 'Your email',
        'url' => 'URL',
        'message' => 'Message'
    );
    $values = $this->__raw()->form->getValues();
    foreach ($fields as $name => $field) {
?>
<tr>
    <td><?php echo $labels[$name]; ?></td>
    <td>
<?php
        $all = array_merge(
            [
                'name' => $name,
                'value' => $values[$name],
                'label' => '',
            ],
            $field->asArray()
        );
        echo $this->field($all) . PHP_EOL;
        $messages = $this->__raw()->form->getMessages($name);
        foreach ($messages as $message) {
            echo $message . PHP_EOL;
        }
?>
    </td>
</tr>
<?php
    }
?>
        </table>
    </form>
</body>
</html>
