<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\View\Sakura;

use Phoenix\Script\BootstrapScript;
use Phoenix\Script\PhoenixScript;
use Phoenix\View\EditView;
use Phoenix\View\ItemView;
use Windwalker\Data\Data;

/**
 * The SakuraHtmlView class.
 *
 * @since  1.0
 */
class SakuraHtmlView extends EditView
{
    /**
     * Property name.
     *
     * @var  string
     */
    protected $name = 'Sakura';

    /**
     * Property formDefinition.
     *
     * @var  string
     */
    protected $formDefinition = 'Edit';

    /**
     * Property formControl.
     *
     * @var  string
     */
    protected $formControl = 'item';

    /**
     * Property formLoadData.
     *
     * @var  boolean
     */
    protected $formLoadData = true;

    /**
     * Property langPrefix.
     *
     * @var  string
     */
    protected $langPrefix = 'mass.';

    /**
     * prepareData
     *
     * @param \Windwalker\Data\Data            $data
     *
     * @see  ItemView
     * ------------------------------------------------------
     * @var  \WindWalker\Structure\Structure   $data ->state
     * @var  \Admin\Record\SakuraRecord $data ->item
     *
     * @see  EditView
     * ------------------------------------------------------
     * @var    \Windwalker\Form\Form           $data ->form
     *
     * @return  void
     */
    protected function prepareData($data)
    {
        parent::prepareData($data);

        $this->prepareScripts($data);
        $this->prepareMetadata($data);
    }

    /**
     * prepareScripts
     *
     * @param Data $data
     *
     * @return  void
     */
    protected function prepareScripts(Data $data)
    {
        PhoenixScript::core();
        PhoenixScript::select2('select.has-select2');
        PhoenixScript::validation();
        BootstrapScript::checkbox(BootstrapScript::FONTAWESOME);
        BootstrapScript::buttonRadio();
        BootstrapScript::tooltip('.has-tooltip');
        PhoenixScript::disableWhenSubmit();
        PhoenixScript::keepAlive($this->package->app->uri->root);
    }

    /**
     * prepareMetadata
     *
     * @param Data $data
     *
     * @return  void
     */
    protected function prepareMetadata(Data $data)
    {
        $this->setTitle();
    }
}
