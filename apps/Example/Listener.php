<?php
namespace Example;

class Listener extends \Prefab
{   
    /*
    This Listener is your main listener and you can add all your system events here, or you can break your listeners out into other files
    
    */

    public function onSystemRebuildMenu($event)
    {
        if ($model = $event->getArgument('model'))
        {
            $root = $event->getArgument('root');
            $example = clone $model;
            
            $example->insert(array(
                'type' => 'admin.nav',
                'priority' => 150,
                'title' => 'Example',
                'icon' => 'fa fa-bolt',
                'is_root' => false,
                'tree' => $root,
                'base' => '/admin/example'
            ));
            
            $children = array(
                array(
                    'title' => 'List',
                    'route' => '/admin/example',
                    'icon' => 'fa fa-bar-chart-o'
                ),
            );
            
            $example->addChildren($children, $root);
            
            \Dsc\System::instance()->addMessage('Example added its admin menu items.');
        }
    }
}