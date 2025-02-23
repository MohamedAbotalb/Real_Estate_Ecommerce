<?php

namespace App\Repositories;

use App\Models\ReportProperty;
use App\Models\ReportUser;
use App\Repositories\Contracts\ReportUserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReportUserRepository implements ReportUserRepositoryInterface
{
    public function getAllReports()
    {
        return ReportUser::all();
    }

    public function findReportById(int $id)
    {
        return ReportUser::find($id);
    }

    public function deleteReportById(int $id)
    {
        $report = ReportUser::find($id);

        if ($report) {
            return $report->delete();
        }

        return false;
    }
    public function deleteUserAndReportById(int $reportId)
    {
        return DB::transaction(function () use ($reportId) {
            $report = ReportUser::find($reportId);

            if ($report) {
                $landlord = $report->landlord;

                if ($landlord) {
                    $landlordReports = ReportUser::where('landlord_id', $landlord->id)->get();

                    foreach ($landlordReports as $landlordReport) {
                        $landlordReport->delete();
                    }

                    $landlord->properties()->each(function ($property) {
                        ReportProperty::where('property_id', $property->id)->delete();
                        $property->delete();
                    });

                    $landlord->delete();
                }

                return $report->delete();
            }

            return false;
        });
    }



    public function createReport(array $data)
    {
        $report = ReportUser::create($data);
        $report->load('reason');
        return $report;
    }
}
