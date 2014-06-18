<?php
namespace Example\Admin;

/**
 * Listeners observe system and custom events.
 * You can add all your system events here,
 * or you can organize your listeners into separate files
 */
class Listener extends \Prefab
{

    public function onSystemRebuildMenu($event)
    {
        if ($model = $event->getArgument('model'))
        {
            $root = $event->getArgument('root');
            $example = clone $model;
            
            $example->insert(array(
                'type' => 'admin.nav',
                'priority' => 10,
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
                )
            );
            
            $example->addChildren($children, $root);
            
            \Dsc\System::instance()->addMessage('Example added its admin menu items.');
        }
    }
}