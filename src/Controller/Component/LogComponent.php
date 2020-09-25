<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Cake\ORM\TableRegistry;

/**
 * Log component
 */
class LogComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    /**
     * ログDB書き込み
     * @param type $class __CLASS__
     * @param type $type __FUNCTION__
     * @param type $content content
     */
    public function write($class, $type, $content)
    {
        $tableLogs = TableRegistry::getTableLocator()->get('Logs');
        $log = $tableLogs->newEntity();
        $log = $tableLogs->patchEntity($log, [
            'm_user_id' => $this->request->session()->read('Auth.User.id'),
            'class' => basename($class),
            'type' => $type,
            'content' => $_SERVER['REMOTE_ADDR'].'/'.$content,
        ]);
        $tableLogs->save($log);
    }
}
