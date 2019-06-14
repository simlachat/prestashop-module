<?php

abstract class SimlachatTestCase extends \PHPUnit\Framework\TestCase
{
    protected $contextMock;

    public function setUp()
    {
        parent::setUp();

        if (version_compare(_PS_VERSION_, '1.7', '>')) {
            $contextMocker = new \LegacyTests\Unit\ContextMocker();
            $this->contextMock = $contextMocker->mockContext();
        }
    }

    protected function setConfig()
    {
        $script= <<<EOT
<script>
  var _rcct = '111111';
  !function (t) {
  } (document);
</script>
EOT;

        Configuration::updateValue(Simlachat::CONSULTANT_SCRIPT, $script);
    }
}
