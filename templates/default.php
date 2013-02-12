<html>
<head>
    <title><?php echo $this->title; ?></title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
        <table cellpadding="0" cellspacing="0">
<?php
    $values = $this->form->getValues();
?>
            <tr>
                <td>Name : </td>
                <td>
                <?php
                    $data = [
                        'form' => $this->form,
                        'values' => $values,
                        'name' => 'name'
                    ];
                    echo $this->partial('_field', $data);
                ?>
                </td>
            </tr>
            <tr>
                <td>Email : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->form,
                        'values' => $values,
                        'name' => 'email'
                    ];
                    echo $this->partial('_field', $data);
                ?>
                </td>
            </tr>
            <tr>
                <td>Url : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->form,
                        'values' => $values,
                        'name' => 'url'
                    ];
                    echo $this->partial('_field', $data);
                ?>
                </td>
            </tr>
            <tr>
                <td>Message : </td>
                <td>
                <?php 
                    $data = [
                        'form' => $this->form,
                        'values' => $values,
                        'name' => 'message'
                    ];
                    echo $this->partial('_field', $data);
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php echo $this->input(['type' => 'submit', 'name' => 'submit', 'value' => 'send']); ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
