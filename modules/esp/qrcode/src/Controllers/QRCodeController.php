<?php

namespace ESP\QRCode\Controllers;

use ESP\QRCode\Models\QRCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use ESP\QRCode\Helpers\QRCodeHelper;
use ESP\QRCode\Helpers\UploadFileToS3;
use Validator;
use File;
use Exception;

class QRCodeController extends Controller
{
    //
    private function validateRequest($request)
    {
        return Validator::make($request, [
            'link' => ['required']
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.qrcode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('pages.qrcode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validated = $this->validateRequest($request->only('link'));
            if ($validated->fails()) {
                toastr()->error($validated->messages()->first());
                return redirect('/qrcode')->withErrors($validated);
            }
            $qrcode = QRCode::create([
                'link' => $request->input('link'),
                'image' => QRCodeHelper::generateCode($request->input('link'), false)
            ]);

            toastr()->success('QR Code saved');
            return redirect('/qrcode');
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->route('qrcode.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \ESP\QRCode\Models\QRCode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function show(QRCode $qrcode)
    {
        // return response()->json([
        //     'qrcode' => $qrcode
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ESP\QRCode\Models\QRCode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function edit(QRCode $qrcode)
    {
        //
        return view('pages.qrcode.edit', ['qrcode' => $qrcode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ESP\QRCode\Models\QRCode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QRCode $qrcode)
    {
        //
        try {
            $validated = $this->validateRequest($request->only('link'));
            if ($validated->fails()) {
                toastr()->error($validated->messages()->first());
                return redirect('/qrcode')->withErrors($validated);
            }

            if ($qrcode->image) {
                File::delete($qrcode->image);
            }
            $qrcode->update([
                'link' => $request->input('link'),
                'image' => QRCodeHelper::generateCode($request->input('link'), false)
            ]);

            toastr()->success('QR Code updated successfully');
            return redirect()->route('qrcode.index');
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->route('qrcode.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ESP\QRCode\Models\QRCode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QRCode $qrcode)
    {
        //
        try {
            if ($qrcode->image) {
                File::delete($qrcode->image);
            }
            $qrcode->delete();
            toastr()->success('QR Code deleted successfully!');
            return redirect()->route('qrcode.index');
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->route('qrcode.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ESP\QRCode\Models\QRCode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $qrcodes = QRCode::where([]);
        $data = DataTables::of($qrcodes)
            ->editColumn('image', function ($dt) {
                return '<img src="'.$dt->image.'" width="150">';
            })
            ->editColumn('link', function ($dt) {
                return '<a href="'.$dt->link.'">'.$dt->link.'</a>';
            })
            ->editColumn('created_at', function ($dt) {
                return $dt->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('qrcode.edit', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('qrcode.destroy', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['image', 'link', 'actions']);
        return $data->make(true);
    }
}
