<!-- Edit Order tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posEditOrderTaxModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('sale.edit_order_tax')</h4>
				<br>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group">
				            {!! Form::label('order_tax_modal', __('sale.order_tax') . ':*' ) !!}
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
				                </span>
				                {!! Form::select('order_tax_modal', $taxes['tax_rates'], $selected_tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control'], $taxes['attributes']); !!}
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posEditOrderTaxModalUpdate">@lang('messages.update')</button>
			    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->