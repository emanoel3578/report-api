<?php

namespace Tests\Unit;

use App\Http\Repositories\Report\ReportRepository;
use App\Http\Services\Report\ReportService;
use Mockery;
use PHPUnit\Framework\TestCase;

class ReportServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_return_report_variable_types_successfully()
    {
        $repositoryMock = Mockery::mock(ReportRepository::class);
        $repositoryMock->shouldReceive('getReports')->andReturn([['sql' => 'Select * from transfer created_at where ${created_at} < 2022-01-01 00:00:00']]);
        $repositoryMock->shouldReceive('getColumnInformation')->andReturn([(object)['parameter_type' => 'timestamp', 'parameter_name' => 'created_at']]);

        $sut = new ReportService($repositoryMock);
        $expected = [
            [
                'table_name' => 'transfer',
                'parameters' => [
                    (object) [
                        'parameter_type' => 'timestamp',
                        'parameter_name' => 'created_at'
                    ]
                ]
            ]
        ];

        $result = $sut->getReports();
        $this->assertEquals($expected, $result);
    }
}

