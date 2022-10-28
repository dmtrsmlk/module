<?php

namespace Small\Eventer\Ui\Component\Listing\Column;

use Small\Eventer\ViewModel\Log\Grid\UrlBuilder;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class prepare Log Actions
 */
class LogActions extends Column
{
    /** Url path */
    const CMS_URL_PATH_EDIT = 'small/log/edit';
    const CMS_URL_PATH_DELETE = 'small/log/delete';

    /**
     * @var UrlBuilder
     */
    private $scopeUrlBuilder;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param $editUrl
     * @param UrlBuilder|null $scopeUrlBuilder
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $actionUrlBuilder,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::CMS_URL_PATH_EDIT,
        UrlBuilder $scopeUrlBuilder = null
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->scopeUrlBuilder = $scopeUrlBuilder ?: ObjectManager::getInstance()
            ->get(\Magento\Cms\ViewModel\Page\Grid\UrlBuilder::class);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['log_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['log_id' => $item['log_id']]),
                        'label' => __('Edit'),
                    ];
                    $title = $this->escapeHtml($item['title']); // ->getEscaper() removed after this
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::CMS_URL_PATH_DELETE, ['log_id' => $item['log_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete a %1 record?', $title),
                        ],
                        'post' => true,
                    ];
                }
                if (isset($item['identifier'])) {
                    $item[$name]['preview'] = [
                        'href' => $this->scopeUrlBuilder->getUrl(
                            $item['identifier'],
                            isset($item['_first_store_id']) ? $item['_first_store_id'] : null,
                            isset($item['store_code']) ? $item['store_code'] : null
                        ),
                        'label' => __('View'),
                        'target' => '_blank'
                    ];
                }
            }
        }

        return $dataSource;
    }

}
