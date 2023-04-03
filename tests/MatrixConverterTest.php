<?php

use KooiCodingChallenge\Models\MatrixConverter;
use PHPUnit\Framework\TestCase;

class MatrixConverterTest extends TestCase
{
    private const FIXTURE_FOLDER = 'fixtures/';
    private const INPUT_FOLDER = 'input/';
    private const EXPECTED_FOLDER = 'output/';
    private MatrixConverter $SUT;

    protected function setUp(): void
    {
        $this->SUT = new MatrixConverter();
    }

    /** @test */
    public function testItConvertsDaysToTimeFrames(): void
    {
        $data = $this->getFixtureData(self::INPUT_FOLDER, 'matrix-1.json');
        $expected = $this->getFixtureData(self::EXPECTED_FOLDER, 'timeframes-1.json');

        $this->assertEquals($expected, $this->SUT->convert($data));
    }

    /** @test */
    public function testItConvertsCrossDaysToTimeFrames(): void
    {
        $data = $this->getFixtureData(self::INPUT_FOLDER, 'matrix-2.json');
        $expected = $this->getFixtureData(self::EXPECTED_FOLDER, 'timeframes-2.json');

        $this->assertEquals($expected, $this->SUT->convert($data));
    }

    private function getFixtureData($folder, $file): mixed
    {
        return json_decode(file_get_contents(self::FIXTURE_FOLDER . $folder . $file), true);
    }
}
