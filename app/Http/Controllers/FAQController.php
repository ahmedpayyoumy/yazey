<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class FAQController extends Controller
{
    public function list()
    {
        return view('faq.list');
    }

    public function data()
    {
        $faqs = Faq::get();
        $data = DataTables::of($faqs)
            ->editColumn('answer', function ($dt) {
                return Str::limit($dt->answer, 200);
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('faq.detail', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('faq.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['actions','answer']);
        return $data->make(true);
    }

    public function detail($id)
    {
        if ($id === 'add') {
            return view('faq.detail');
        }
        $faq = Faq::find($id);
        if (empty($faq)) {
            toastr()->error('Không tìm thấy faq!');
            return redirect()->back();
        }
        return view('faq.detail', [
            'faq' => $faq,
        ]);
    }

    public function create(Request $request)
    {
        if (!$request->get('answer')) {
            toastr()->error('Vui lòng nhập câu trả lời');
            return redirect()->back();
        }
        Faq::create([
            'question' => $request->get('question'),
            'answer' => $request->get('answer'),
        ]);
        toastr()->success('Thêm faq thành công!');
        return redirect()->route('faq.list');
    }

    public function update($id, Request $request)
    {
        if (!$request->get('answer')) {
            toastr()->error('Vui lòng nhập câu trả lời');
            return redirect()->back();
        }
        $faq = Faq::find($id);
        if (empty($faq)) {
            toastr()->error('Không tìm thấy faq!');
            return redirect()->back();
        }
        $faq->update([
            'question' => $request->get('question'),
            'answer' => $request->get('answer'),
        ]);
        toastr()->success('Cập nhật faq thành công!');
        return redirect()->route('faq.list');
    }

    public function delete($id)
    {
        $faq = Faq::find($id);
        if (empty($faq)) {
            toastr()->error('Không tìm thấy faq!');
            return redirect()->back();
        }
        $faq->delete();
        toastr()->success('Xóa faq thành công!');
        return redirect()->route('faq.list');
    }
}
