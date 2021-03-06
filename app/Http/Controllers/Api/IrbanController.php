<?php

namespace App\Http\Controllers\Api;

use App\Libraries\Common;
use App\Models\Irban;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;

class IrbanController extends Controller
{
    protected $_common;

    public function __construct()
    {
        $this->_common = new Common();
    }

    public function get_data()
    {
        try {
            $irban = Irban::all();
            return response()->json(['data'=>$irban,'total'=>count($irban)], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show_data(Request $request)
    {
        return response()->json(Irban::find($request['id']), 200);
    }

    public function post_data(Request $request)
    {
        try {
            $check_data = Irban::where('nama_irban', $request->input('nama_irban'))->count();
            if ($check_data == 0) {
                $irban = new Irban();
                $irban->nama_irban = $request->input('nama_irban');
                $irban->created_at = date('Y-m-d H:i:s');
                if ($irban->save()) {
                    $payload = [
                        'page' => 'Irban',
                        'message' => 'User dengan NIP '.$request->query('nip').' menambahkan data irban baru'
                    ];
                    $this->_common->generate_log($payload);

                    return response()->json(['status' => 'ok'], 200);
                } else {
                    return response()->json(['status' => 'failed'], 500);
                }
            } else {
                return response()->json(['status' => 'duplicate'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function put_data(Request $request)
    {
        try {
            $irban = Irban::find($request['id']);
            $irban->nama_irban = $request->input('nama_irban');
            $irban->updated_at = date('Y-m-d H:i:s');
            if ($irban->save()) {
                $payload = [
                    'page' => 'Irban',
                    'message' => 'User dengan NIP '.$request->query('nip').' melakukan perubahan pada data irban'
                ];
                $this->_common->generate_log($payload);
                return response()->json(['status' => 'ok'], 200);
            } else {
                return response()->json(['status' => 'failed'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete_data(Request $request)
    {
        try {
            $irban = Irban::find($request['id']);
            if ($irban->delete()) {
                $payload = [
                    'page' => 'Irban',
                    'message' => 'User dengan NIP '.$request->query('nip').' melakukan hapus data pada irban'
                ];
                $this->_common->generate_log($payload);
                return response()->json(['status' => 'ok'], 200);
            } else {
                return response()->json(['status' => 'failed'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
