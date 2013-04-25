<?php
namespace Domicile\Example;

use Aura\Input\Form;

class ContactForm extends Form
{
    public function init()
    {
        $this->setField('name')
            ->setAttribs([
                'id' => 'name',
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('email')
            ->setAttribs([
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('url')
            ->setAttribs([
                'size' => 20,
                'maxlength' => 20,
            ]);
        $this->setField('message', 'textarea')
            ->setAttribs([
                'cols' => 40,
                'rows' => 5,
            ]);
        $this->setField('submit', 'submit')
            ->setAttribs(['value' => 'send']);
        
        $filter = $this->getFilter();
        
        $filter->addSoftRule('name', $filter::IS, 'string');
        $filter->addSoftRule('name', $filter::IS, 'strlenMin', 4);
        $filter->addSoftRule('email', $filter::IS, 'email');
        $filter->addSoftRule('url', $filter::IS, 'url');
        $filter->addSoftRule('message', $filter::FIX, 'string');
        $filter->addSoftRule('message', $filter::FIX, 'strlenMin', 6);
    }
}
