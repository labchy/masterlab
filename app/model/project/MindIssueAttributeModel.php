<?php

namespace main\app\model\project;

use main\app\model\CacheModel;

/**
 * 事项主题思维导图的格式
 */
class MindIssueAttributeModel extends CacheModel
{
    public $prefix = 'mind_';

    public $table = 'issue_attribute';

    const   DATA_KEY = 'mind_issue_attribute/';

    /**
     * ProjectRoleModel constructor.
     * @param string $uid
     * @param bool $persistent
     * @throws \Exception
     */
    public function __construct($uid = '', $persistent = false)
    {
        parent::__construct($uid, $persistent);
        $this->uid = $uid;
    }

    /**
     * 获取某个设置信息
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        return $this->getRowById($id);
    }

    /**
     * 新增事项主题的思维导图格式
     * @param $info
     * @param $projectId
     * @return array
     * @throws \Exception
     */
    public function insertByProjectId($info, $projectId)
    {
        $info ['project_id'] = $projectId;
        $flag = $this->insert($info);
        return $flag;
    }

    /**
     * 更新事项主题思维导图格式
     * @param $updateInfo
     * @param $projectId
     * @return array
     * @throws \Exception
     */
    public function updateByProjectId($updateInfo, $projectId)
    {
        $where = ['project_id' => $projectId];
        $flag = $this->update($updateInfo, $where);
        return $flag;
    }

    /**
     * 替换
     * @param $updateInfo
     * @return array
     * @throws \Exception
     */
    public function replaceByProjectId($updateInfo)
    {
        $flag = $this->replace($updateInfo);
        return $flag;
    }

    /**
     * 获取某个事项主题的思维导图格式
     * @return array
     */
    public function getByProject($projectId)
    {
        return $this->getRows('*', ['project_id' => $projectId]);
    }

    /**
     * @param $projectId
     * @param $source
     * @param $groupBy
     * @return array
     */
    public function getByProjectSourceGroupBy($projectId, $source, $groupBy)
    {
        $condition = [];
        $condition['project_id'] = $projectId;
        $condition['source'] = $source;
        $condition['group_by'] = $groupBy;
        $rows = $this->getRows('*', $condition);
        $keyArr = [];
        foreach ($rows as $row) {
            $keyArr[$row['issue_id']] = $row;
        }
        unset($rows);
        return $keyArr;
    }

    /**
     * 删除事项主题的思维导图格式
     * @param $projectId
     * @return int
     */
    public function deleteByProjectId( $projectId)
    {
        $where = ['project_id' => $projectId];
        $flag = $this->delete($where);
        return $flag;
    }
}