<?php
    namespace App\Controller\Component;
    
    use Cake\Controller\Component;
    use Cake\ORM\TableRegistry;
    
    class SidebarComponent extends Component
    {
        public function index()
        {
            $stations = TableRegistry::getTableLocator()->get('StationsStores');
            $lists = $stations->find('all')->contain(['Stations'])->all();
            return $lists;
        }
    }