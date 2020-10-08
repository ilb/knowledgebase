<?php


namespace usecase\groups;


use usecase\helper\UseCase;

class GetGroups extends UseCase {

    /**
     * @return array[]|\response\Response|void
     */
    public function execute() {
        $result = [];
        $groups = posix_getgroups();
        foreach ($groups as $groupid) {
            $result[] = posix_getgrgid($groupid);
        }
        return $result;
    }
}