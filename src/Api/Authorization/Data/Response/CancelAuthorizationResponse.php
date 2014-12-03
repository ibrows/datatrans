<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Constants;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CancelAuthorizationResponse extends AbstractAuthorizationResponse
{
    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppMsgType(ExecutionContextInterface $context)
    {
        $uppMsgType = $this->getUppMsgType();

        if(Constants::MSGTYPE_GET !== $uppMsgType) {
            $context->addViolationAt('status', "Invalid uppMsgType '{$uppMsgType}' given!");
        }
    }
}