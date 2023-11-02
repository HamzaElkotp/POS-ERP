@if (!$account_exist)
    <table class="table table-bordered table-striped">
        <tr>
            <td colspan="10" class="text-center">
                <h3>@lang('accounting::lang.no_accounts')</h3>
                <p>@lang('accounting::lang.add_default_accounts_help')</p>
                <a href="{{ route('accounting.create-default-accounts') }}"
                    class="btn btn-success btn-xs">@lang('accounting::lang.add_default_accounts') <i class="fas fa-file-import"></i></a>
            </td>
        </tr>
    </table>
@else

<div class="row">
    <div class="col-md-4 mb-12 col-md-offset-4">
        <div class="input-group">
            <input type="input" class="form-control" id="accounts_tree_search">
            <span class="input-group-addon">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary btn-sm" id="expand_all">@lang('accounting::lang.expand_all')</button>
        <button class="btn btn-primary btn-sm" id="collapse_all">@lang('accounting::lang.collapse_all')</button>
    </div>
    <div class="col-md-12" id="accounts_tree_container">

        <ul>
               
  
            @foreach ($account_types as $key => $value)
                <li @if ($loop->index == 0) data-jstree='{ "opened" : true }' @endif>
                    {{ $value }} 
                    <ul>
                        {{-- Second Level --}}
                        @foreach ($account_sub_types->where('account_primary_type', $key)->all() as $sub_type)
                            <li @if ($loop->index == 0) data-jstree='{ "opened" : true }' @endif>
                               {{$sub_type->id}} - {{ $sub_type->account_type_name }}
                                <ul>
                                    {{-- Third Level --}}
                                    @foreach ($accounts
                                                        ->where('account_sub_type_id', $sub_type->id)->sortBy('name')
                                                        ->whereNull('parent_account_id')
                                                         ->all() as $account)
                                        <li
                                            @if (count($account->child_accounts) == 0) data-jstree='{ "icon" : "fas fa-arrow-alt-circle-right" }' @endif>
                                            @if ($account->parent_account_id == null)
                                                {{ $account->id }}

                                                {{ $account->name }}

                                                @if (!empty($account->gl_code))
                                                    ({{ $account->gl_code }})
                                                @endif
                                                - @format_currency($account->balance)
                                                @if ($account->status == 'active')
                                                    <span><i class="fas fa-check text-success"
                                                            title="@lang('accounting::lang.active')"></i></span>
                                                @elseif($account->status == 'inactive')
                                                    <span><i class="fas fa-times text-danger" title="@lang('lang_v1.inactive')"
                                                            style="font-size: 14px;"></i></span>
                                                @endif
                                                <span class="tree-actions">
                                                    <a class="btn btn-xs btn-default text-success  m-5 btn-modal"
                                                        title="@lang('accounting::lang.add')"
                                                        href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger1'], $account->id) }}"
                                                        data-href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger1'], $account->id) }}"
                                                        data-container="#create_account_modal">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <a class="btn btn-xs btn-default text-success ledger-link"
                                                        title="@lang('accounting::lang.ledger')"
                                                        href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $account->id) }}">
                                                        <i class="fas fa-file-alt"></i></a>
                                                    <a class="btn-modal btn-xs btn-default text-primary"
                                                        title="@lang('messages.edit')"
                                                        href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id) }}"
                                                        data-href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id) }}"
                                                        data-container="#create_account_modal">
                                                        <i class="fas fa-edit"></i></a>
                                                    <a class="activate-deactivate-btn text-warning  btn-xs btn-default"
                                                        title="@if ($account->status == 'active') @lang('messages.deactivate') @else 
                                                    @lang('messages.activate') @endif"
                                                        href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $account->id) }}">
                                                        <i class="fas fa-power-off"></i>
                                                    </a>
                                                </span>

                                                @include('manageChild', [
                                                    'childs' => $account->child_accounts,
                                                    'levels' => $levels[0]
                                                ])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
