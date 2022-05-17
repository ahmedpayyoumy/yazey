<style>
    .table-blur {}

    .table-blur tbody tr:hover {
        background: transparent !important;
        color: #000 !important;
    }

    .dashboard__class .section__table .tb__header .hd__right {
        display: none !important;
    }
</style>

<table class="table  table-blur">
    <thead>
        <tr>
            <th class="th__tb">Rank No.</th>
            <th class="th__tb">Store Industry</th>
            <th class="th__tb">Monthly Traffic</th>
            <th class="th__tb">Monthly Sales</th>
            <th class="th__tb">Marketing Spend</th>
            <th class="th__tb">Marketing ROAS</th>
            <th class="th__tb">Marketing</th>
        </tr>
    </thead>
    <tbody id="post_data" style="filter: blur(4px);">

        <?php
        for ($i = 1; $i <= 10; $i++) {
        ?>

            <tr class="ajaxdata " data-id="1">
                <td class="td__tb">
                    <div class="d-flex gap5 align-item-center justify-content-center"><?php echo $i; ?></div>
                </td>
                <td class="td__tb">Book</td>
                <td class="td__tb">4567</td>
                <td class="td__tb">$ 262</td>
                <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                <td class="td__tb ">$ 36.3</td>
                <td class="td__tb ">2.000X</td>
                <td class="td__tb connect-agency__">
                    @if( in_array($i,[1,3,5]))
                    <div class="tag__green">AGENCY</div>
                    @else
                    <div class="tag__gray">
                        IN-HOUSE
                    </div>
                    @endif
                </td>
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>