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

    /**
     * @var \Magento\Customer\Block\DataProviders\AddressAttributeData
     */
    private $attributeData;

    /**
     * @var \Magento\Customer\ViewModel\Address\RegionProvider
     */
    private $regionProvider;

    /**
     * @var \Magento\Customer\ViewModel\CreateAccountButton
     */
    private $createAccountButtonViewModel;

    public function __construct(
        PageFactory $pageFactory,
        JsonFactory $jsonFactory,
        \Magento\Customer\Block\DataProviders\AddressAttributeData $addressAttributeData,
        \Magento\Customer\ViewModel\Address\RegionProvider $regionProvider,
        \Magento\Customer\ViewModel\CreateAccountButton $createAccountButtonViewModel
    ) {
        $this->pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->attributeData = $addressAttributeData;
        $this->regionProvider = $regionProvider;
        $this->createAccountButtonViewModel = $createAccountButtonViewModel;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        /** @var \Know\Module\Block\Form\Register $block */
        $block = $resultPage->getLayout()
            ->createBlock(\Know\Module\Block\Form\Register::class);
        $block->setData('attribute_data' , $this->attributeData);
        $block->setData('region_provider' , $this->regionProvider);
        $block->setData('create_account_button_view_model' , $this->createAccountButtonViewModel);
        $html = $block->setTemplate('Magento_Customer::form/register.phtml')
            ->toHtml();

        $resultJson = $this->jsonFactory->create();
        $resultJson->setData([
            'data' => $html
        ]);
        return $resultJson;
    }
}
