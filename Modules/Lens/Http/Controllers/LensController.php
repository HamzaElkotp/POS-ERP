<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLenRequest;
use Modules\LensHttp\Requests\StoreLenRequest;
use Modules\LensHttp\Requests\UpdateLenRequest;
use Modules\Lens\Entities\Len;

use Auth;
use Modules\Lens\Entities\LensDiameter;
use Modules\Lens\Entities\Signaltype;
use Modules\Lens\Entities\SphFrom;
use Modules\Lens\Entities\SphTo;
use Modules\Lens\Entities\Cylinder;
use Modules\Lens\Entities\LensDiam;
use Modules\Lens\Entities\LensDiam2;
use Modules\Lens\Entities\LensDiam3;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LensController extends Controller
{
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');

        abort_if(Gate::denies('read_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lens = Len::with(['signal_type', 'lens_diameter', 'sph_from', 'sph_to'])->where('business_id', $business_id)->get();
        // dd($lens );

        return view('lens::lens.index', compact('lens'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signal_types = Signaltype::all()->pluck('signal_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lens_diameters = LensDiameter::all()->pluck('lens_diameter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_froms = SphFrom::all()->pluck('sph_from', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_tos = SphTo::all()->pluck('sph_to', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('lens::lens.create', compact('signal_types', 'lens_diameters', 'sph_froms', 'sph_tos'));
    }

    public function store(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');

        $items = array();
        $request->request->add(['business_id' => $business_id]);

        $len = Len::create($request->all());
        $items = array();
        $sph_from = $request->sph_from_id;
        $sph_to = $request->sph_to_id;

        for ($i = $sph_from; $i >= $sph_from, $i <= $sph_to; $i += 0.25) {
            $items[] = ['len_id' => $len->id, 'sph' => $i];
            // array_push($i,$len->id);
        }
        // dd($items,$request->sph_from_id,$sph_to);
        $len_diam = LensDiam::insert($items);
        $len_diam2 = LensDiam2::insert($items);
        $len_diam3 = LensDiam3::insert($items);
        return redirect()->route('lens.index');
    }

    public function store_quant(Request $request, $id)
    {

        $sph_from = $request->sph_from_id;
        $sph_to = $request->sph_to_id;
        // dd($sph_to);
        $val = $request->val;
        $cyl_n = $request->cyl_n;
        $cyl_n2 = $request->cyl_n2;
        $cyl = 0;
        $list = [];
        for ($i = $cyl_n; $i >= $cyl_n, $i <= $cyl_n2; $i += 0.25) {
            switch ($i) {

                case '0.00':
                    $cyl = 's00';
                    // alert(cyl);
                    array_push($list, [$cyl]);

                    break;

                // case '+0.25':
                //     $cyl = 's25';
                //     array_push($list , [$cyl]);

                //     break;

                // case '+0.50':
                //     $cyl = 's50';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+0.75':
                //     $cyl = 's75';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+1.00':
                //     $cyl = 's100';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.25':
                //     $cyl = 's125';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.50':
                //     $cyl = 's150';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.75':
                //     $cyl = 's175';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.00':
                //     $cyl = 's200';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.25':
                //     $cyl = 's225';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+2.50':
                //         $cyl = 's250';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+2.75':
                //     $cyl = 's275';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.00':
                //     $cyl = 's300';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.25':
                //     $cyl = 's325';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+3.50':
                //         $cyl = 's350';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+3.75':
                //     $cyl = 's375';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.000':
                //     $cyl = 's400';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.25':
                //     $cyl = 's425';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.50':
                //     $cyl = 's450';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.75':
                //     $cyl = 's475';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.00':
                //     $cyl = 's500';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.25':
                //     $cyl = 's525';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.50':
                //     $cyl = 's550';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.75':
                //     $cyl = 's575';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+6.00':
                //     $cyl = 's600';
                //     array_push($list , [$cyl]);
                //     break;

                case '-0.25':
                    $cyl = '_s25';
                    array_push($list, [$cyl]);
                    break;

                case '-0.50':
                    $cyl = '_s50';
                    array_push($list, [$cyl]);
                    break;
                case '-0.75':
                    $cyl = '_s75';
                    array_push($list, [$cyl]);
                    break;
                case '-1.00':
                    $cyl = '_s100';
                    array_push($list, [$cyl]);
                    break;
                case '-1.25':
                    $cyl = '_s125';
                    array_push($list, [$cyl]);
                    break;
                case '-1.50':
                    $cyl = '_s150';
                    array_push($list, [$cyl]);
                    break;
                case '-1.75':
                    $cyl = '_s175';
                    array_push($list, [$cyl]);
                    break;
                case '-2.00':
                    $cyl = '_s200';
                    array_push($list, [$cyl]);
                    break;
                case '-2.25':
                    $cyl = '_s225';
                    array_push($list, [$cyl]);
                    break;
                case '-2.50':
                    $cyl = '_s250';
                    array_push($list, [$cyl]);
                    break;
                case '-2.75':
                    $cyl = '_s275';
                    array_push($list, [$cyl]);
                    break;
                case '-3.00':
                    $cyl = '_s300';
                    array_push($list, [$cyl]);
                    break;
                case '-3.25':
                    $cyl = '_s325';
                    array_push($list, [$cyl]);
                    break;
                case '-3.50':
                    $cyl = '_s350';
                    array_push($list, [$cyl]);
                    break;
                case '-3.75':
                    $cyl = '_s375';
                    array_push($list, [$cyl]);
                    break;
                case '-4.000':
                    $cyl = '_s400';
                    array_push($list, [$cyl]);
                    break;
                case '-4.25':
                    $cyl = '_s425';
                    array_push($list, [$cyl]);
                    break;
                case '-4.50':
                    $cyl = '_s450';
                    array_push($list, [$cyl]);
                    break;
                case '-4.75':
                    $cyl = '_s475';
                    array_push($list, [$cyl]);
                    break;
                case '-5.00':
                    $cyl = '_s500';
                    array_push($list, [$cyl]);
                    break;
                case '-5.25':
                    $cyl = '_s525';
                    array_push($list, [$cyl]);
                    break;
                case '-5.50':
                    $cyl = '_s550';
                    array_push($list, [$cyl]);
                    break;
                case '-5.75':
                    $cyl = '_s575';
                    array_push($list, [$cyl]);
                    break;
                case '-6.00':
                    $cyl = '_s600';
                    array_push($list, [$cyl]);
                    break;


            }

        }
        //    dd($list);

        foreach ($list as $item) {
            $lens = LensDiam::where('len_id', $id)
                ->whereBetween('sph', [$sph_from, $sph_to])
                ->update(array($item[0] => $val));

        }

        return back();
    }
    public function store_quant1(Request $request, $id)
    {

        $len = Len::find($id);
        $sphs = $request->input('sph', []);
        $s00s = $request->input('s00', []);
        // dd($request);
        // $s25s = $request->input('s25', []);
        // $s50s = $request->input('s50', []);
        // $s75s = $request->input('s75', []);
        // $s100s = $request->input('s100', []);
        // $s125s = $request->input('s125', []);
        // $s150s = $request->input('s150', []);
        // $s175s = $request->input('s175', []);
        // $s200s = $request->input('s200', []);
        // $s225s = $request->input('s225', []);
        // $s250s = $request->input('s250', []);
        // $s275s = $request->input('s275', []);
        // $s300s = $request->input('s300', []);
        // $s325s = $request->input('s325', []);
        // $s350s = $request->input('s350', []);
        // $s375s = $request->input('s375', []);
        // $s400s = $request->input('s400', []);
        // $s425s = $request->input('s425', []);
        // $s450s = $request->input('s450', []);
        // $s475s = $request->input('s475', []);
        // $s500s = $request->input('s500', []);
        // $s525s = $request->input('s525', []);
        // $s550s = $request->input('s550', []);
        // $s575s = $request->input('s575', []);
        // $s600s = $request->input('s600', []);

        $_s25s = $request->input('_s25', []);
        $_s50s = $request->input('_s50', []);
        $_s75s = $request->input('_s75', []);
        $_s100s = $request->input('_s100', []);
        $_s125s = $request->input('_s125', []);
        $_s150s = $request->input('_s150', []);
        $_s175s = $request->input('_s175', []);
        $_s200s = $request->input('_s200', []);
        $_s225s = $request->input('_s225', []);
        $_s250s = $request->input('_s250', []);
        $_s275s = $request->input('_s275', []);
        $_s300s = $request->input('_s300', []);
        $_s325s = $request->input('_s325', []);
        $_s350s = $request->input('_s350', []);
        $_s375s = $request->input('_s375', []);
        $_s400s = $request->input('_s400', []);
        $_s425s = $request->input('_s425', []);
        $_s450s = $request->input('_s450', []);
        $_s475s = $request->input('_s475', []);
        $_s500s = $request->input('_s500', []);
        $_s525s = $request->input('_s525', []);
        $_s550s = $request->input('_s550', []);
        $_s575s = $request->input('_s575', []);
        $_s600s = $request->input('_s600', []);


        $lens_diams = LensDiam::where('len_id', '=', $id)->get();
        foreach ($lens_diams as $org) {
            $org->delete();
        }

        for ($product = 0; $product < count($sphs); $product++) {
            if ($sphs[$product] != '') {
                $len->len_lenses_diams()->insert(
                    [
                        'len_id' => $len->id,
                        'sph' => $sphs[$product],
                        's00' => $s00s[$product],

                        // 's25'     => $s25s[$product],
                        // 's50'     => $s50s[$product],
                        // 's75'     => $s75s[$product],
                        // 's100'     => $s100s[$product],
                        // 's125'     => $s125s[$product],
                        // 's150'     => $s150s[$product],
                        // 's175'     => $s175s[$product],
                        // 's200'     => $s200s[$product],
                        // 's225'     => $s225s[$product],
                        // 's250'     => $s250s[$product],
                        // 's275'     => $s275s[$product],
                        // 's300'     => $s300s[$product],
                        // 's325'     => $s325s[$product],
                        // 's350'     => $s350s[$product],
                        // 's375'     => $s375s[$product],
                        // 's400'     => $s400s[$product],
                        // 's425'     => $s425s[$product],
                        // 's450'     => $s450s[$product],
                        // 's475'     => $s475s[$product],
                        // 's500'     => $s500s[$product],
                        // 's525'     => $s525s[$product],
                        // 's550'     => $s550s[$product],
                        // 's575'     => $s575s[$product],
                        // 's600'     => $s600s[$product],

                        '_s25' => $_s25s[$product],
                        '_s50' => $_s50s[$product],
                        '_s75' => $_s75s[$product],
                        '_s100' => $_s100s[$product],
                        '_s125' => $_s125s[$product],
                        '_s150' => $_s150s[$product],
                        '_s175' => $_s175s[$product],
                        '_s200' => $_s200s[$product],
                        '_s225' => $_s225s[$product],
                        '_s250' => $_s250s[$product],
                        '_s275' => $_s275s[$product],
                        '_s300' => $_s300s[$product],
                        '_s325' => $_s325s[$product],
                        '_s350' => $_s350s[$product],
                        '_s375' => $_s375s[$product],
                        '_s400' => $_s400s[$product],
                        '_s425' => $_s425s[$product],
                        '_s450' => $_s450s[$product],
                        '_s475' => $_s475s[$product],
                        '_s500' => $_s500s[$product],
                        '_s525' => $_s525s[$product],
                        '_s550' => $_s550s[$product],
                        '_s575' => $_s575s[$product],
                        '_s600' => $_s600s[$product],

                    ]
                );
            }
        }
        return back();
    }

    public function store_purch_price(Request $request, $id)
    {
        $sph_from = $request->sph_from_id;
        $sph_to = $request->sph_to_id;
        $val = $request->val;
        $cyl_n = $request->cyl_n;
        $cyl_n2 = $request->cyl_n2;
        $cyl = 0;
        $list = [];

        for ($i = $cyl_n; $i >= $cyl_n, $i <= $cyl_n2; $i += 0.25) {
            switch ($i) {
                case '0.00':
                    $cyl = 's00';
                    // alert(cyl);
                    array_push($list, [$cyl]);

                    break;

                // case '+0.25':
                //     $cyl = 's25';
                //     array_push($list , [$cyl]);

                //     break;

                // case '+0.50':
                //     $cyl = 's50';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+0.75':
                //     $cyl = 's75';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+1.00':
                //     $cyl = 's100';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.25':
                //     $cyl = 's125';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.50':
                //     $cyl = 's150';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.75':
                //     $cyl = 's175';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.00':
                //     $cyl = 's200';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.25':
                //     $cyl = 's225';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+2.50':
                //         $cyl = 's250';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+2.75':
                //     $cyl = 's275';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.00':
                //     $cyl = 's300';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.25':
                //     $cyl = 's325';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+3.50':
                //         $cyl = 's350';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+3.75':
                //     $cyl = 's375';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.000':
                //     $cyl = 's400';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.25':
                //     $cyl = 's425';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.50':
                //     $cyl = 's450';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.75':
                //     $cyl = 's475';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.00':
                //     $cyl = 's500';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.25':
                //     $cyl = 's525';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.50':
                //     $cyl = 's550';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.75':
                //     $cyl = 's575';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+6.00':
                //     $cyl = 's600';
                //     array_push($list , [$cyl]);
                //     break;

                case '-0.25':
                    $cyl = '_s25';
                    array_push($list, [$cyl]);
                    break;

                case '-0.50':
                    $cyl = '_s50';
                    array_push($list, [$cyl]);
                    break;
                case '-0.75':
                    $cyl = '_s75';
                    array_push($list, [$cyl]);
                    break;
                case '-1.00':
                    $cyl = '_s100';
                    array_push($list, [$cyl]);
                    break;
                case '-1.25':
                    $cyl = '_s125';
                    array_push($list, [$cyl]);
                    break;
                case '-1.50':
                    $cyl = '_s150';
                    array_push($list, [$cyl]);
                    break;
                case '-1.75':
                    $cyl = '_s175';
                    array_push($list, [$cyl]);
                    break;
                case '-2.00':
                    $cyl = '_s200';
                    array_push($list, [$cyl]);
                    break;
                case '-2.25':
                    $cyl = '_s225';
                    array_push($list, [$cyl]);
                    break;
                case '-2.50':
                    $cyl = '_s250';
                    array_push($list, [$cyl]);
                    break;
                case '-2.75':
                    $cyl = '_s275';
                    array_push($list, [$cyl]);
                    break;
                case '-3.00':
                    $cyl = '_s300';
                    array_push($list, [$cyl]);
                    break;
                case '-3.25':
                    $cyl = '_s325';
                    array_push($list, [$cyl]);
                    break;
                case '-3.50':
                    $cyl = '_s350';
                    array_push($list, [$cyl]);
                    break;
                case '-3.75':
                    $cyl = '_s375';
                    array_push($list, [$cyl]);
                    break;
                case '-4.000':
                    $cyl = '_s400';
                    array_push($list, [$cyl]);
                    break;
                case '-4.25':
                    $cyl = '_s425';
                    array_push($list, [$cyl]);
                    break;
                case '-4.50':
                    $cyl = '_s450';
                    array_push($list, [$cyl]);
                    break;
                case '-4.75':
                    $cyl = '_s475';
                    array_push($list, [$cyl]);
                    break;
                case '-5.00':
                    $cyl = '_s500';
                    array_push($list, [$cyl]);
                    break;
                case '-5.25':
                    $cyl = '_s525';
                    array_push($list, [$cyl]);
                    break;
                case '-5.50':
                    $cyl = '_s550';
                    array_push($list, [$cyl]);
                    break;
                case '-5.75':
                    $cyl = '_s575';
                    array_push($list, [$cyl]);
                    break;
                case '-6.00':
                    $cyl = '_s600';
                    array_push($list, [$cyl]);
                    break;


            }

        }

        foreach ($list as $item) {
            $lens = LensDiam3::where('len_id', $id)
                ->whereBetween('sph', [$sph_from, $sph_to])
                ->update(array($item[0] => $val));

        }

        return back();
    }
    public function store_sell_price(Request $request, $id)
    {
        $sph_from = $request->sph_from_id;
        $sph_to = $request->sph_to_id;
        $val = $request->val;
        $cyl_n = $request->cyl_n;
        $cyl_n2 = $request->cyl_n2;
        $cyl = 0;
        $list = [];
        // dd($val);

        for ($i = $cyl_n; $i >= $cyl_n, $i <= $cyl_n2; $i += 0.25) {
            array_push($list, [$cyl]);
            switch ($i) {
                case '0.00':
                    $cyl = 's00';
                    // alert($cyl);
                    array_push($list, [$cyl]);
                    // dd($list);
                    break;

                // case '+0.25':
                //     $cyl = 's25';
                //     array_push($list , [$cyl]);

                //     break;

                // case '+0.50':
                //     $cyl = 's50';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+0.75':
                //     $cyl = 's75';
                //     array_push($list , [$cyl]);

                //     break;
                // case '+1.00':
                //     $cyl = 's100';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.25':
                //     $cyl = 's125';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.50':
                //     $cyl = 's150';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+1.75':
                //     $cyl = 's175';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.00':
                //     $cyl = 's200';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+2.25':
                //     $cyl = 's225';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+2.50':
                //         $cyl = 's250';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+2.75':
                //     $cyl = 's275';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.00':
                //     $cyl = 's300';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+3.25':
                //     $cyl = 's325';
                //     array_push($list , [$cyl]);
                //     break;
                //     case '+3.50':
                //         $cyl = 's350';
                //         array_push($list , [$cyl]);
                //         break;
                // case '+3.75':
                //     $cyl = 's375';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.000':
                //     $cyl = 's400';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.25':
                //     $cyl = 's425';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.50':
                //     $cyl = 's450';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+4.75':
                //     $cyl = 's475';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.00':
                //     $cyl = 's500';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.25':
                //     $cyl = 's525';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.50':
                //     $cyl = 's550';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+5.75':
                //     $cyl = 's575';
                //     array_push($list , [$cyl]);
                //     break;
                // case '+6.00':
                //     $cyl = 's600';
                //     array_push($list , [$cyl]);
                //     break;

                case '-0.25':
                    $cyl = '_s25';
                    array_push($list, [$cyl]);
                    break;

                case '-0.50':
                    $cyl = '_s50';
                    array_push($list, [$cyl]);
                    break;
                case '-0.75':
                    $cyl = '_s75';
                    array_push($list, [$cyl]);
                    break;
                case '-1.00':
                    $cyl = '_s100';
                    array_push($list, [$cyl]);
                    break;
                case '-1.25':
                    $cyl = '_s125';
                    array_push($list, [$cyl]);
                    break;
                case '-1.50':
                    $cyl = '_s150';
                    array_push($list, [$cyl]);
                    break;
                case '-1.75':
                    $cyl = '_s175';
                    array_push($list, [$cyl]);
                    break;
                case '-2.00':
                    $cyl = '_s200';
                    array_push($list, [$cyl]);
                    break;
                case '-2.25':
                    $cyl = '_s225';
                    array_push($list, [$cyl]);
                    break;
                case '-2.50':
                    $cyl = '_s250';
                    array_push($list, [$cyl]);
                    break;
                case '-2.75':
                    $cyl = '_s275';
                    array_push($list, [$cyl]);
                    break;
                case '-3.00':
                    $cyl = '_s300';
                    array_push($list, [$cyl]);
                    break;
                case '-3.25':
                    $cyl = '_s325';
                    array_push($list, [$cyl]);
                    break;
                case '-3.50':
                    $cyl = '_s350';
                    array_push($list, [$cyl]);
                    break;
                case '-3.75':
                    $cyl = '_s375';
                    array_push($list, [$cyl]);
                    break;
                case '-4.000':
                    $cyl = '_s400';
                    array_push($list, [$cyl]);
                    break;
                case '-4.25':
                    $cyl = '_s425';
                    array_push($list, [$cyl]);
                    break;
                case '-4.50':
                    $cyl = '_s450';
                    array_push($list, [$cyl]);
                    break;
                case '-4.75':
                    $cyl = '_s475';
                    array_push($list, [$cyl]);
                    break;
                case '-5.00':
                    $cyl = '_s500';
                    array_push($list, [$cyl]);
                    break;
                case '-5.25':
                    $cyl = '_s525';
                    array_push($list, [$cyl]);
                    break;
                case '-5.50':
                    $cyl = '_s550';
                    array_push($list, [$cyl]);
                    break;
                case '-5.75':
                    $cyl = '_s575';
                    array_push($list, [$cyl]);
                    break;
                case '-6.00':
                    $cyl = '_s600';
                    array_push($list, [$cyl]);
                    break;


            }

        }
        dd($list);

        foreach ($list as $item) {
            $lens = LensDiam2::where('len_id', $id)
                ->whereBetween('sph', [$sph_from, $sph_to])
                ->update(array($item[0] => $val));
            // dd($lens);
        }

        return back();
    }

    public function edit(Len $len)
    {
        abort_if(Gate::denies('update_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signal_types = Signaltype::all()->pluck('signal_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lens_diameters = LensDiameter::all()->pluck('lens_diameter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_froms = SphFrom::all()->pluck('sph_from', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_tos = SphTo::all()->pluck('sph_to', 'id')->prepend(trans('global.pleaseSelect'), '');

        $len->load('signal_type', 'lens_diameter', 'sph_from', 'sph_to');

        return view('lens::lens.edit', compact('signal_types', 'lens_diameters', 'sph_froms', 'sph_tos', 'len'));
    }

    public function update(Request $request, Len $len)
    {
        $len->update($request->all());
        $lens_diams = LensDiam::where('len_id', '=', $len->id)->get();
        foreach ($lens_diams as $org) {
            $org->delete();
        }

        $items = array();
        $sph_from = $request->sph_from_id;
        $sph_to = $request->sph_to_id;
        for ($i = 0; $i >= $sph_from, $i <= $sph_to; $i += 0.25) {
            $items[] = ['len_id' => $len->id, 'sph' => $i];
        }
        // dd($items);

        $len_diam = LensDiam::insert($items);
        // $len_diam2 = LensDiam2::insert($items);
        // $len_diam3 = LensDiam3::insert($items);

        return redirect()->route('lens::lens.index');
    }


    public function show(Len $len)
    {
        abort_if(Gate::denies('show_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $len->load('len_lenses_diams');
        $sph_froms = SphFrom::all()->pluck('sph_from', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_tos = SphTo::all()->pluck('sph_to', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cylinders = Cylinder::all()->pluck('cylinder', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('lens::lens.show', compact('len', 'sph_froms', 'sph_tos', 'cylinders'));
    }

    public function show2($len)
    {
        abort_if(Gate::denies('show_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $len = Len::find($len);
        // dd($len);

        $len->load('len_lenses_diams2');
        $sph_froms = SphFrom::all()->pluck('sph_from', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_tos = SphTo::all()->pluck('sph_to', 'id')->prepend(trans('global.pleaseSelect'), '');


        $cylinders = Cylinder::all()->pluck('cylinder', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('lens::lens.show2', compact('len', 'sph_froms', 'sph_tos', 'cylinders'));
    }

    public function show3($len)
    {
        abort_if(Gate::denies('show_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $len = Len::find($len);

        $len->load('len_lenses_diams3');
        $sph_froms = SphFrom::all()->pluck('sph_from', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sph_tos = SphTo::all()->pluck('sph_to', 'id')->prepend(trans('global.pleaseSelect'), '');


        $cylinders = Cylinder::all()->pluck('cylinder', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('lens::lens.show3', compact('len', 'sph_froms', 'sph_tos', 'cylinders'));
    }

    public function show4($id)
    {
        abort_if(Gate::denies('show_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $len = Len::find($id);

        $len->load('len_lenses_diams');
        // dd($len);

        return view('lens::lens.show4', compact('len'));
    }

    public function show5($id)
    {
        $len = Len::find($id);

        $len->load('len_lenses_diams');
        // dd($len1);
        return view('lens::lens.show5', compact('len'));

    }

    public function destroy(Len $len)
    {
        abort_if(Gate::denies('delete_lenses'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $len_diam = LensDiam::where('len_id', '=', $len->id);
        // dd($len_diam);

        $len_diam->delete();
        $len_diam1 = LensDiam2::where('len_id', '=', $len->id);
        $len_diam1->delete();

        $len_diam2 = LensDiam3::where('len_id', '=', $len->id);
        $len_diam2->delete();


        $len->delete();

        return back();
    }

    public function massDestroy(MassDestroyLenRequest $request)
    {
        Len::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_lens($id, $sph, $cyl)
    {
        // dd($cyl);
        // $cyl = 's25';
        $lens_diam = LensDiam::where('len_id', '=', $id)
            ->where('sph', '=', $sph)
            // ->where('s25', '=', $cyl)
            ->select('len_id', 'sph', $cyl, 'id')
            ->get();
        //   dd( $lens_diam);
        return response()->json($lens_diam);
    }
    public function get_lens_price($id, $sph, $cyl)
    {
        // dd($request);
        // $cyl = 's25';
        $lens_diam = LensDiam2::where('len_id', '=', $id)
            ->where('sph', '=', $sph)
            // ->where($cyl, '=', $cyl)
            ->select('len_id', 'sph', $cyl, 'id')
            ->get();
        //   dd( $lens_diam);
        return response()->json($lens_diam);
    }

    public function get_lens_purch_price($id, $sph, $cyl)
    {
        // dd($request);
        // $cyl = 's25';
        $lens_diam = LensDiam3::where('len_id', '=', $id)
            ->where('sph', '=', $sph)
            // ->where($cyl, '=', $cyl)
            ->select('len_id', 'sph', $cyl, 'id')
            ->get();
        //   dd( $lens_diam);
        return response()->json($lens_diam);
    }

}