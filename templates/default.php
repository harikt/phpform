<html>
<head>
    <title><?php echo $this->title; ?></title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
        <table cellpadding="0" cellspacing="0">
<?php
    $values = $this->__raw()->form->getValues();
?>
            <tr>
                <td>Name : </td>
                <td>
                <?php 
                    //$form = $this->__raw()->form;
                    $template_vars = ['item' => $item];
                    $data = [
                        'form' => $form,
                        'values' => $values,
                        'name' => 'name'
                    ];
                    echo $this->fetch('_field', $template_vars);                    
                ?>
                </td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->__raw()->form,
                        'values' => $values,
                        'name' => 'email'
                    ];
                    //echo $this->fetch('partial_field', $data);                    
                ?>
                </td>
            </tr>
            <tr>
                <td>Url : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->__raw()->form,
                        'values' => $values,
                        'name' => 'url'
                    ];
                    //echo $this->fetch('partial_field', $data);                    
                ?>
                </td>
            </tr>
            <tr>
                <td>Message : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->__raw()->form,
                        'values' => $values,
                        'name' => 'message'
                    ];
                    //echo $this->fetch('partial_field', $data);                    
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php echo $this->input(['type' => 'submit', 'name' => 'submit'], 'Send'); ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
