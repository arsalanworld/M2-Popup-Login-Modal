<?php
namespace Know\Module\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    private PageFactory $pageFactory;

    private JsonFactory $resultJsonFactory;

    public function __construct(PageFactory $pageFactory, JsonFactory $resultJsonFactory)
    {
        $this->pageFactory = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $jsonResult = $this->resultJsonFactory->create();

        $jsonResult->setData([
            'data' => $resultPage->getLayout()
                ->createBlock(\Know\Module\Block\Form\Register::class)
                ->setTemplate('Magento_Customer::form/register.phtml')
                ->toHtml()
        ]);
        return $jsonResult;
    }
}
