<?php

declare(strict_types=1);

namespace Esplin\Test\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Esplin\Test\Logger\Logger;
use Exception;

/**
 * Handles inline and massaction updates
 */
class InlineEdit extends Action implements HttpPostActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_resultJsonFactory;

    /**
     * @var \ECInternet\Sage300PurchaseOrders\Logger\Logger
     */
    private $_logger;

    /**
     * @param \Magento\Backend\App\Action\Context              $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Esplin\Test\Logger\Logger                       $logger
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $resultJsonFactory,
        Logger $logger
    ) {
        $this->_resultJsonFactory                  = $resultJsonFactory;
        $this->_logger                             = $logger;

        parent::__construct($context);
    }

    /**
     * Inline edit action execute
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $this->log('execute()');

        $messages = [];
        $error    = false;

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->_resultJsonFactory->create();

        // Cache POST data
        $postData = $this->getPostData();
        $this->log('execute()', ['postData' => $postData]);

        // Return early if data is bad
        if (!($this->getRequest()->getParam('isAjax') && count($postData))) {
            return $resultJson->setData(
                [
                    'messages' => [
                        __('Please correct the data sent.')
                    ],
                    'error' => true,
                ]
            );
        }

        foreach (array_keys($postData) as $lineId) {
            $this->log('execute()', ['postItem' => (array)$postData[$lineId]]);
            try {
                $this->save($postData[$lineId]);
            } catch (Exception $e) {
                $this->log('execute()', ['exception' => $e->getMessage()]);
                $messages[] = $e->getMessage();
                $error      = true;
            }
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error'    => $error
            ]
        );
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws \Exception
     */
    private function save($data)
    {
        $this->log('save()', ['data' => $data]);
    }

    private function getPostData()
    {
        return $this->getRequest()->getParam('items', []);
    }

    private function log($message, $extra = [])
    {
        $this->_logger->info('Controller/Adminhtml/Index/InlineEdit - ' . $message, $extra);
    }
}
