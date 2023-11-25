

<div class="row">
    <div class="col-12">
        الفص الطبي

        <table>
            <tr>
                <th class="th1">Left</th>
                <th class="th1">Right</th>
            </tr>
        </table>
        <table class="table1">

            <tr>
                <th class="th1">Axis</th>
                <th class="th1">Cyl</th>

                <th class="th1">Sph</th>

                <th class="th1">Axis</th>
                <th class="th1">Cyl</th>

                <th class="th1">Sph</th>

                <th class="th1"></th>

            </tr>
            <tr>
                <td class="td1">{{ $salesInvoice->axis1 }}</td>
                <td class="td1">{{ $salesInvoice->cyl1 }}</td>
                <td class="td1">{{ $salesInvoice->sph1 }}</td>

                <td class="td1">{{ $salesInvoice->axis }}</td>
                <td class="td1">{{ $salesInvoice->cyl }}</td>
                <td class="td1">{{ $salesInvoice->sph }}</td>
                <td class="td1">Dist.</td>

            </tr>
        </table>
        <table class="table1">
            <td class="td1">{{ $salesInvoice->add }}</td>
            <th class="th1">Add</th>

            <td class="td1">{{ $salesInvoice->ipd_d }}</td>
            <th class="th1">IPD/D</th>

            <td class="td1">{{ $salesInvoice->add1 }}</td>
            <th class="th1">Add</th>
        </table>

    </div>

</div>
