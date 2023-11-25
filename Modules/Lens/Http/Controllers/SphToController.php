<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySphToRequest;
use App\Http\Requests\StoreSphToRequest;
use App\Http\Requests\UpdateSphToRequest;
use App\Models\SphTo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SphToController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read_sph_to'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphTos = SphTo::all();

        return view('admin.sphTos.index', compact('sphTos'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_sph_to'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sphTos.create');
    }

    public function store(StoreSphToRequest $request)
    {
        $sphTo = SphTo::create($request->all());

        return redirect()->route('admin.sph-tos.index');
    }

    public function edit(SphTo $sphTo)
    {
        abort_if(Gate::denies('update_sph_to'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sphTos.edit', compact('sphTo'));
    }

    public function update(UpdateSphToRequest $request, SphTo $sphTo)
    {
        $sphTo->update($request->all());

        return redirect()->route('admin.sph-tos.index');
    }

    public function show(SphTo $sphTo)
    {
        abort_if(Gate::denies('show_sph_to'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphTo->load('sphToLens');

        return view('admin.sphTos.show', compact('sphTo'));
    }

    public function destroy(SphTo $sphTo)
    {
        abort_if(Gate::denies('delete_sph_to'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphTo->delete();

        return back();
    }

    public function massDestroy(MassDestroySphToRequest $request)
    {
        SphTo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
