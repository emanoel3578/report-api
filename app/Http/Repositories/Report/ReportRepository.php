<?php

namespace App\Http\Repositories\Report;

use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportRepository 
{
  protected Report $model;

  public function __construct(Report $reportModel)
  {
    $this->model = $reportModel;
  }

  public function getReports(): array
  {
    return $this->model->select('sql')->get()->toArray();
  }

  public function getColumnInformation(string $tableName, array $columnNames)
  {
    return DB::table('INFORMATION_SCHEMA.COLUMNS')
    ->select(['DATA_TYPE as parameter_type', 'COLUMN_NAME as parameter_name'])
    ->where('TABLE_NAME', '=', $tableName)
    ->whereIn('COLUMN_NAME', $columnNames)
    ->get()
    ->toArray();
  }
}