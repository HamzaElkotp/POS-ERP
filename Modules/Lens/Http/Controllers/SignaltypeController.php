<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySignaltypeRequest;
use App\Http\Requests\StoreSignaltypeRequest;
use App\Http\Requests\UpdateSignaltypeRequest;
use App\Models\Signaltype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SignaltypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read_signal_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaltypes = Signaltype::all();

        return view('admin.signaltypes.index', compact('signaltypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_signal_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.signaltypes.create');
    }

    public function store(StoreSignaltypeRequest $request)
    {
        $signaltype = Signaltype::create($request->all());

        return redirect()->route('admin.signaltypes.index');
    }

    public function edit(Signaltype $signaltype)
    {
        abort_if(Gate::denies('update_signal_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.signaltypes.edit', compact('signaltype'));
    }

    public function update(UpdateSignaltypeRequest $request, Signaltype $signaltype)
    {
        $signaltype->update($request->all());

        return redirect()->route('admin.signaltypes.index');
    }

    public function show(Signaltype $signaltype)
    {
        abort_if(Gate::denies('show_signal_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaltype->load('signalTypeLens');

        return view('admin.signaltypes.show', compact('signaltype'));
    }

    public function destroy(Signaltype $signaltype)
    {
        abort_if(Gate::denies('delete_signal_type'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaltype->delete();

        return back();
    }

    public function massDestroy(MassDestroySignaltypeRequest $request)
    {
        Signaltype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
