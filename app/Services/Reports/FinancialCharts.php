<?php


namespace App\Services\Reports;


use App\Charts\ReportCharts;
use App\Enum\Enum;
use App\Helpers\Helper;
use App\Models\Financial;
use Illuminate\Support\Facades\DB;

class FinancialCharts
{
    public function __construct(private Financial $financial)
    {
    }
    public function getReports(int $year = null, string $type = 'bar')
    {
        $year = $year ?? date('Y');

        $chart = new ReportCharts();

        $chart->labels(Enum::months());

        $this->getReceber($chart, $type, $year);

        $this->getPagar($chart, $type, $year);

        return $chart;
    }


    public function byMonths(int $year, string $type): array
    {
        $data = [];

         for ($i = 1; $i <= 12; $i++) {
           $data[$i] =  $this->financial
                 ->select(DB::raw('sum(payment) as total'))
                 ->whereYear('due_date', $year)
                 ->whereMonth('due_date', $i)
                 ->where('type', $type)
                 ->groupBy(DB::raw('MONTH(due_date)'))
                 ->pluck('total')
                 ->toArray();
         }

        return  array_values($data);
    }

    /**
     * @param ReportCharts $chart
     * @param string $type
     * @param int|string $year
     * @param string $color
     */
    private function getReceber(ReportCharts $chart, string $type, int|string $year): void
    {
        $color = Helper::colorRand();

        $chart->dataset('A Receber', $type, $this->byMonths($year, 'Receber'))
            ->options([
                'color' => $color,
                'backgroundColor' => $color
            ]);
    }

    /**
     * @param ReportCharts $chart
     * @param string $type
     * @param int|string $year
     * @param string $color
     */
    private function getPagar(ReportCharts $chart, string $type, int|string $year): void
    {
        $color = Helper::colorRand();

        $chart->dataset('A Pagar', $type, $this->byMonths($year, 'Pagar'))
            ->options([
                'color' => $color,
                'backgroundColor' => $color
            ]);
    }
}
