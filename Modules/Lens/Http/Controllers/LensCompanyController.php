<?php

namespace Modules\Lens\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLensCompanyRequest;
use App\Http\Requests\StoreLensCompanyRequest;
use App\Http\Requests\UpdateLensCompanyRequest;
use App\Models\LensCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LensCompanyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read_lens_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensCompanies = LensCompany::all();

        return view('admin.lensCompanies.index', compact('lensCompanies'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_lens_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lensCompanies.create');
    }

    public function store(StoreLensCompanyRequest $request)
    {
        $lensCompany = LensCompany::create($request->all());

        return redirect()->route('admin.lens-companies.index');
    }

    public function edit(LensCompany $lensCompany)
    {
        abort_if(Gate::denies('update_lens_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lensCompanies.edit', compact('lensCompany'));
    }

    public function update(UpdateLensCompanyRequest $request, LensCompany $lensCompany)
    {
        $lensCompany->update($request->all());

        return redirect()->route('admin.lens-companies.index');
    }

    public function show(LensCompany $lensCompany)
    {
        abort_if(Gate::denies('show_lens_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensCompany->load('lensCompProducts');

        return view('admin.lensCompanies.show', compact('lensCompany'));
    }

    public function destroy(LensCompany $lensCompany)
    {
        abort_if(Gate::denies('delete_lens_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lensCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyLensCompanyRequest $request)
    {
        LensCompany::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
