<?php
namespace Domicile\Example\Input;

use Domicile\Example\Input\Form;

class ContactForm extends Form
{
    public function initFilter()
    {
        $filter = $this->getFilter();
        $filter->addSoftRule('name', $filter::IS, 'string');
        $filter->addSoftRule('email', $filter::IS, 'email');
        $filter->addSoftRule('url', $filter::IS, 'url');
        $filter->addSoftRule('message', $filter::FIX, 'string');
        $filter->addSoftRule('message', $filter::FIX, 'strlenMin', 6);
    }
    
    public function init()
    {
        $this->setField('name');
        $this->setField('email');
        $this->setField('url');
        $this->setField('message', 'textarea');
        $submit = $this->setField('submit', 'submit');
        $this->setValues(['submit' => 'send']);
    }
}
