<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLensDiameterRequest;
use App\Http\Requests\StoreLensDiameterRequest;
use App\Http\Requests\UpdateLensDiameterRequest;
use App\Models\LensDiameter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LensDiameterController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read_lens_diamete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensDiameters = LensDiameter::all();

        return view('admin.lensDiameters.index', compact('lensDiameters'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_lens_diamete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lensDiameters.create');
    }

    public function store(Request $request)
    {
        $lensDiameter = LensDiameter::create($request->all());

        return redirect()->route('admin.lens-diameters.index');
    }

    public function edit(LensDiameter $lensDiameter)
    {
        abort_if(Gate::denies('update_lens_diamete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lensDiameters.edit', compact('lensDiameter'));
    }

    public function update(UpdateLensDiameterRequest $request, LensDiameter $lensDiameter)
    {
        $lensDiameter->update($request->all());

        return redirect()->route('admin.lens-diameters.index');
    }

    public function show(LensDiameter $lensDiameter)
    {
        abort_if(Gate::denies('show_lens_diamete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensDiameter->load('lensDiameterLens');

        return view('admin.lensDiameters.show', compact('lensDiameter'));
    }

    public function destroy(LensDiameter $lensDiameter)
    {
        abort_if(Gate::denies('delete_lens_diamete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensDiameter->delete();

        return back();
    }

    public function massDestroy(MassDestroyLensDiameterRequest $request)
    {
        LensDiameter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}