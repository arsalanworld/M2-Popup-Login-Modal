<?php
namespace Know\Module\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    private PageFactory $pageFactory;

    private JsonFactory $jsonFactory;

    public function __construct(PageFactory $pageFactory, JsonFactory $jsonFactory)
    {
        $this->pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $html = $resultPage->getLayout()
            ->createBlock(\Know\Module\Block\Form\Register::class)
            ->setTemplate('Magento_Customer::form/register.phtml')
            ->toHtml();

        $resultJson = $this->jsonFactory->create();
        $resultJson->setData([
            'data' => $html
        ]);
        return $resultJson;
    }
}
