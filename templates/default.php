<html>
<head>
    <title><?php echo $this->title; ?></title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" >
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>Name : </td>
                <td>
                <?php
                    echo $this->field($this->form->get('name'));
                    $data = [
                        'form' => $this->form,
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
                    echo $this->field($this->form->get('email'));
                    $data = [
                        'form' => $this->form,
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
                    echo $this->field($this->form->get('url'));
                    $data = [
                        'form' => $this->form,
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
                    echo $this->field($this->form->get('message'));
                    $data = [
                        'form' => $this->form,
                        'name' => 'message'
                    ];
                    echo $this->partial('_field', $data);
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php 
                echo $this->field($this->form->get('submit'));
                //echo $this->input(['type' => 'submit', 'name' => 'submit', 'value' => 'send']); ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
