<?php
class uniConfigUserGetListProcessor extends modObjectGetListProcessor {
  public $classKey = 'modUser';
  public $languageTopics = array('user');
  public $defaultSortField = 'username';


  /**
   * @param xPDOQuery $c
   *
   * @return xPDOQuery
   */
  public function prepareQueryBeforeCount(xPDOQuery $c)
  {
    $c->leftJoin('modUserProfile', 'Profile');
    $c->innerJoin ('modUserGroupMember','UserGroupMembers');
    $c->innerJoin ('modUserGroup','UserGroup','`UserGroupMembers`.`user_group` = `UserGroup`.`id`');
    $c->leftJoin  ('modUserGroupRole','UserGroupRole','`UserGroupMembers`.`role` = `UserGroupRole`.`id`');
    $id = $this->getProperty('id');
    if (!empty($id) AND $this->getProperty('combo')) {
      $c->sortby("FIELD (modUser.id, {$id})", "DESC");
    }
    $query = $this->getProperty('query', '');
    $c->where(array(
      'UserGroup.name' => 'ManagerLocation',
    ));
    if (!empty($query)) {
      $c->where(array(
        'modUser.username:LIKE' => "%{$query}%",
        'OR:Profile.fullname:LIKE' => "%{$query}%",
        'OR:Profile.email:LIKE' => "%{$query}%",
      ));
    }
    return $c;
  }
  /**
   * @param xPDOQuery $c
   *
   * @return xPDOQuery
   */
  public function prepareQueryAfterCount(xPDOQuery $c)
  {
    $c->select($this->modx->getSelectColumns('modUser', 'modUser'));
    $c->select($this->modx->getSelectColumns('modUserProfile', 'Profile', '', array('fullname')));
    return $c;
  }
  public function prepareRow(xPDOObject $object) {
    $array = $object->toArray();
    if ($this->getProperty('combo')) {
      $array = array(
        'id'       => $array['id'],
        'fullname' => !empty($array['fullname']) ? $array['fullname'] : $array['username'],
      );
    }
    return $array;
  }

}

return 'uniConfigUserGetListProcessor';