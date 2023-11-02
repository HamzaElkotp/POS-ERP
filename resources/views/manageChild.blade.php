<ul>

    @foreach ($childs as $child)
        <li>
            {{ $child->id }}-{{ $child->name }}
            @if (!empty($child->gl_code))
                ({{ $child->gl_code }})
            @endif
            - @format_currency($child->balance)
            @if ($child->status == 'active')
                <span><i class="fas fa-check text-success" title="@lang('accounting::lang.active')"></i></span>
            @elseif($child->status == 'inactive')
                <span><i class="fas fa-times text-danger" title="@lang('lang_v1.inactive')" style="font-size: 14px;"></i></span>
            @endif
            <span class="tree-actions">
                @if ($child->level < $levels)
                  <a class="btn btn-xs btn-default text-success  m-5 btn-modal" title="@lang('accounting::lang.add')"
                    href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger1'], $child->id) }}"
                    data-href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger1'], $child->id) }}"
                    data-container="#create_account_modal">
                    <i class="fas fa-plus"></i>
                </a>
  
                @endif
                <a class="btn btn-xs btn-default text-success ledger-link" title="@lang('accounting::lang.ledger')"
                    href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $child->id) }}">
                    <i class="fas fa-file-alt"></i></a>
                <a class="btn-modal btn-xs btn-default text-primary" title="@lang('messages.edit')"
                    href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child->id) }}"
                    data-href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child->id) }}"
                    data-container="#create_account_modal">
                    <i class="fas fa-edit"></i></a>
                <a class="activate-deactivate-btn text-warning  btn-xs btn-default"
                    title="@if ($account->status == 'active') @lang('messages.deactivate') @else 
                            @lang('messages.activate') @endif"
                    href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $child->id) }}">
                    <i class="fas fa-power-off"></i>
                </a>
            </span>

            @if (count($child->child_accounts))
                @include('manageChild', ['childs' => $child->child_accounts])
            @endif
        </li>
    @endforeach
</ul>
