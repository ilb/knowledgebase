<?php


namespace usecase\report;


use response\Response;
use usecase\helper\UseCase;

class Report  extends UseCase {

    /**
     * Тип отчета
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct($type) {
        $this->type = $type;
    }

    /**
     * @return array[]|Response
     */
    public function execute() {
        $result = null;
        if ($this->type == "subscriptions") {
            $result = $this->repository->getReportSubscribe();
        } else {
            $result = $this->repository->getReportOffer();
        }
        return new Response($result);
    }
}