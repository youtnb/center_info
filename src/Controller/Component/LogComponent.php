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
    
    public function write($class, $type, $content)
    {
        $tableLogs = TableRegistry::getTableLocator()->get('Logs');
        $log = $tableLogs->newEntity();
        $log = $tableLogs->patchEntity($log, [
            'm_user_id' => $this->request->session()->read('Auth.User.id'),
            'class' => basename($class),
            'type' => $type,
            'content' => $content,
        ]);
        $tableLogs->save($log);
    }
}
