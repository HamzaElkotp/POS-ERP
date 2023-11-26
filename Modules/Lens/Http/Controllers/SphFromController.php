<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySphFromRequest;
use App\Http\Requests\StoreSphFromRequest;
use App\Http\Requests\UpdateSphFromRequest;
use App\Models\SphFrom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SphFromController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read_sph_from'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphFroms = SphFrom::all();

        return view('admin.sphFroms.index', compact('sphFroms'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_sph_from'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sphFroms.create');
    }

    public function store(StoreSphFromRequest $request)
    {
        $sphFrom = SphFrom::create($request->all());

        return redirect()->route('admin.sph-froms.index');
    }

    public function edit(SphFrom $sphFrom)
    {
        abort_if(Gate::denies('update_sph_from'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sphFroms.edit', compact('sphFrom'));
    }

    public function update(UpdateSphFromRequest $request, SphFrom $sphFrom)
    {
        $sphFrom->update($request->all());

        return redirect()->route('admin.sph-froms.index');
    }

    public function show(SphFrom $sphFrom)
    {
        abort_if(Gate::denies('show_sph_from'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphFrom->load('sphFromLens');

        return view('admin.sphFroms.show', compact('sphFrom'));
    }

    public function destroy(SphFrom $sphFrom)
    {
        abort_if(Gate::denies('delete_sph_from'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sphFrom->delete();

        return back();
    }

    public function massDestroy(MassDestroySphFromRequest $request)
    {
        SphFrom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
