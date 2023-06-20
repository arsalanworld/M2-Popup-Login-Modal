<?php
namespace Know\Module\Block\Form;

class Register extends \Magento\Customer\Block\Form\Register
{
    public function getPostActionUrl()
    {
        return $this->getUrl('module/index/createpost');
    }
}
