<?php
namespace Domicile\Example;

use Aura\Input\Form;

class ContactForm extends Form
{
    public function init()
    {
        $this->setField('name');
        $this->setField('email');
        $this->setField('url');
        $this->setField('message', 'textarea');
        
        $filter = $this->getFilter();
        $filter->addSoftRule('name', $filter::IS, 'string');
        $filter->addSoftRule('name', $filter::IS, 'strlenMin', 4);
        $filter->addSoftRule('email', $filter::IS, 'email');
        $filter->addSoftRule('url', $filter::IS, 'url');
        $filter->addSoftRule('message', $filter::FIX, 'string');
        $filter->addSoftRule('message', $filter::FIX, 'strlenMin', 6);
    }
}
