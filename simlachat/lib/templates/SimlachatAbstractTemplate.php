<?php
/*
 * PHP version 7.1
 *
 * @category Integration
 * @author   RetailCRM <integration@retailcrm.ru>
 * @license  http://retailcrm.ru Proprietary
 * @link     http://retailcrm.ru
 * @see      http://help.retailcrm.ru
 */

/**
 * Class SimlachatAbstractTemplate
 */
abstract class SimlachatAbstractTemplate
{
    /** @var Module */
    protected $module;
    protected $smarty;
    protected $assets;

    /** @var string */
    protected $template;
    /** @var array */
    protected $data;

    private $errors;

    /**
     * SimlachatAbstractTemplate constructor.
     *
     * @param Module $module
     * @param $smarty
     * @param $assets
     */
    public function __construct(Module $module, $smarty, $assets)
    {
        $this->module = $module;
        $this->smarty = $smarty;
        $this->assets = $assets;
    }

    /**
     * @param $file
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function render($file)
    {
        $this->setTemplate();

        if (null === $this->template) {
            throw new \RuntimeException("Template not be blank");
        }

        $this->smarty->assign(\array_merge($this->data, array('errors' => $this->errors)));

        return $this->module->display($file, "views/templates/admin/$this->template");
    }

    /**
     * @param $errors
     *
     * @return self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    abstract protected function setTemplate();
}
