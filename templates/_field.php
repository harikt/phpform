<?php
$field = $this->form->getField($this->name);
$value = isset($this->values[$this->name]) ? $this->values[$this->name] : null;
$all = array_merge(
    [
        'name' => $this->name,
        'value' => $value,
        'label' => '',
    ],
    $field
);
echo $this->field($all);
$errors = $this->form->getMessages($this->name);
if ($errors) {
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
?>
