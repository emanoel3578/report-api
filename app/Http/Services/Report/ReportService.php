<?php

namespace App\Http\Services\Report;

use App\Http\Repositories\Report\ReportRepository;

class ReportService
{
  private ReportRepository $reportRepository;

  public function __construct(ReportRepository $reportRepository)
  {
    $this->reportRepository = $reportRepository;
  }

  public function getReports()
  {
    $allSqls = $this->reportRepository->getReports();

    $reportInformation = array_map(function($reportSql) {
      $tableInfo = $this->getTableAndVariableNameFromReportSql($reportSql['sql']);
      $formatedTableInformation = $this->getFormatedTableInformation($tableInfo);
      return $formatedTableInformation;
    }, $allSqls);

    return $reportInformation;
  }

  private function getTableAndVariableNameFromReportSql(string $sql)
  {
    $bindings = [];
    $tableName = [];

    preg_match('/\bfrom\s+\K\S+/', $sql, $tableName);
    preg_match_all('/[^{\}]+(?=})/', $sql, $bindings[$tableName[0]]);

    return $bindings;
  }

  private function getFormatedTableInformation(array $bindings)
  {
    foreach($bindings as $tableName => $columnNames) {
      $tableFormatedInfo = [];
      $tableFormatedInfo['table_name'] = $tableName;
      $tableFormatedInfo['parameters'] = $this->reportRepository->getColumnInformation($tableName, $columnNames[0]);
      return $tableFormatedInfo;
    }
  }
}