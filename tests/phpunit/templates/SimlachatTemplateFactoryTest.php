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

class SimlachatTemplateFactoryTest extends SimlachatTestCase
{
    protected $module;
    protected $factory;

    public function __construct()
    {
        $this->module = new Simlachat();
        $this->factory = new SimlachatTemplateFactory(
            Context::getContext()->smarty,
            __DIR__ . '/../../../simlachat/views'
        );
    }

    public function testCreateTemplateBase()
    {
        $template = $this->factory->createTemplate($this->module);

        $this->assertInstanceOf(SimlachatBaseTemplate::class, $template);
        $this->assertInstanceOf(SimlachatAbstractTemplate::class, $template);
    }

    public function testCreateTemplateSettings()
    {
        Configuration::set(Simlachat::URL, 'https://example.simlachat.com');
        Configuration::set(Simlachat::API_KEY, 'api_key');

        $template = $this->factory->createTemplate($this->module);

        $this->assertInstanceOf(SimlachatSettingsTemplate::class, $template);
        $this->assertInstanceOf(SimlachatAbstractTemplate::class, $template);
    }

    public function testCreateTemplateConsultant()
    {
        Configuration::set(Simlachat::URL, 'https://example.simlachat.com');
        Configuration::set(Simlachat::API_KEY, 'api_key');
        $_GET["item"] = "consultant";

        $template = $this->factory->createTemplate($this->module);

        $this->assertInstanceOf(SimlachatConsultantTemplate::class, $template);
        $this->assertInstanceOf(SimlachatAbstractTemplate::class, $template);
    }
}
