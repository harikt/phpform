<html>
<head>
    <title><?php echo $this->title; ?></title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
<?php
    $fields = $this->__raw()->form->getFields();
    $values = $this->__raw()->form->getValues();
    foreach ($fields as $name => $field) {
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
    }
?>
    </form>
</body>
</html>
