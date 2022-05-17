<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityLogController extends Controller
{
    //
    public function list()
    {
        return view('activity-log.list');
    }

    public function data(Request $request)
    {
        $activities = Activity::where([]);
        $data = DataTables::of($activities)
            ->filter(function ($query) use ($request) {
                if ($request->search) {
                    $query->where('description', 'like', '%'.$request->search.'%');
                }
            })
            ->editColumn('select_activity', function ($dt) {
                return '<input type="checkbox" name="id[]" value="'.$dt->id.'"/>';
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('activity-log.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['select_activity', 'description', 'actions']);
        return $data->make(true);
    }

    public function deleteSelectedIds(Request $request)
    {
        $logIds = $request->id;
        if ($logIds) {
            $logIds = json_decode($logIds, true);
            if (is_array($logIds)) {
                Activity::whereIn('id', $logIds)->delete();
                toastr()->success('Xoá activity log thành công!');
            }
        }
        toastr()->error('Không tìm thấy activity log!');
        return redirect()->route('activity-log.list');
    }

    public function deleteAll()
    {
        Activity::where([])->delete();
        toastr()->success('Xoá tất cả activity log thành công!');
        return redirect()->route('activity-log.list');
    }
}
