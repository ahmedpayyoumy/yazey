<style>
    .firsttable {
        overflow-y: scroll;
        max-height: 545px;
        width: 100%;
        overflow-x: hidden;
    }

    .dashboard__class .section__table .tb__header .hd__right {
        display: none !important;
    }

    .highlight {
        background-color: #2026E9;
        color: white;
    }
    .upgrader{
        position: absolute;
        left: 40%;
        top: 50%;
    }
    .upgrader2{
        position: absolute;
        left: 40%;
        top: 50%;
    }
</style>
<?php
$permission = Auth::user()->permission;
if ($permission) {
    $check_permission = explode(",", $permission);
} else {
    $check_permission = [];
}

$userRand = rand(50, 100);
if (in_array('roas_ranking_table', $check_permission)) {
?>
    <div class="col-md-12 tb__content datatable datatable-default">
        <div style="z-index: 1;">
            <a href="#" style="cursor: pointer;z-index:2;" class="upgrader"><img src="{{asset('images/Upgrade.png')}}" width="200" class="img" alt=""></a>
        </div>
        <div class="firsttable">
            <?php if ($has_user) { ?>
                <table class="table table1">
                    <thead>
                        <tr>
                            <th class="th__tb">
                                Rank No.
                            </th>
                            <th class="th__tb">
                                Monthly Traffic
                            </th>
                            <th class="th__tb">
                                CPC
                            </th>

                            <th class="th__tb">
                                Site Demographic
                            </th>
                            <th class="th__tb">
                                Avg Cart Size
                            </th>
                            <th class="th__tb">
                                Monthly Sales
                            </th>
                            <th class="th__tb">
                                Marketing Spend
                            </th>
                            <th class="th__tb">
                                Marketing ROAS
                            </th>
                            <th class="th__tb">
                                Marketing
                            </th>
                        </tr>
                    </thead>
                    <tbody id="post_data">

                        {{-- loop --}}
                        <?php $main = 1; ?>
                        @if (count($reports))

                        @foreach ($reports as $report)
                        {{-- {{dd($reports)}} --}}
                        {{-- {{$report->cost_per_inline_link_click}} --}}
                        <tr class="ajaxdata {{auth()->id() == $report->user_id ? 'highlight' :''}}" data-id="<?php echo $main; ?>">
                            <td class="td__tb">
                                <div class="d-flex gap5 align-item-center justify-content-center">
                                    @if (in_array('rank_no',$check_permission))
                                    {{$main}}
                                    @else
                                    <div style="padding: 5px">
                                        #
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="td__tb">
                                @if (in_array('monthly_traffic',$check_permission))
                                    {{ $report->traffic }}
                                @else
                                <div style="padding: 5px">
                                    <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                </div>

                                @endif
                            </td>
                            <td class="td__tb ">
                                <?php if (in_array('marketing_roas', $check_permission)) { ?>
                                    $<?= $report->avg_cpc; ?>
                                <?php } else { ?>
                                    <div style="padding: 5px">
                                        <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                    </div>
                                <?php } ?>
                            </td>


                            <td class="td__tb" style="filter: blur(5px);">{{ $report->industriesname}}</td>

                            <td class="td__tb" style="filter: blur(5px);">$
                                @if($report->user_id == auth()->id())
                                {{ $userRand}}
                                @else
                                {{ rand(50,200)}}
                                @endif
                            </td>
                            <td class="td__tb" style="filter: blur(5px);">
                                @if (in_array('monthly_sale',$check_permission))

                                $ {{$report->reach_total}}

                                @else
                                <div style="padding: 5px">
                                    <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                </div>

                                @endif
                            </td>
                            <!--<td class="td__tb"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>-->
                            <td class="td__tb " style="filter: blur(5px);">
                                @if (in_array('marketing_spend',$check_permission))

                                $ {{$report->spend_total? $report->spend_total:0}}
                                @else
                                <div style="padding: 5px">
                                    <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                </div>
                                @endif
                            </td>
                            <td class="td__tb" style="filter: blur(5px);">
                                <?php if (in_array('marketing_roas', $check_permission)) { ?>

                                    <?php echo number_format($report->roas, 3, '.', ''); ?>X

                                <?php } else { ?>
                                    <div style="padding: 5px">
                                        <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                    </div>
                                <?php } ?>
                            </td>


                            <td class="td__tb connect-agency">
                                <div class="tag__green">
                                    {{ $report->marketing_type?$report->marketing_type: ''}}

                                </div>
                            </td>


                        </tr>
                        <?php $main++; ?> @endforeach
                        @endif

                    </tbody>
                </table>
        </div>
        <table class="table table-more">
            <thead class="sec-thead">
                <tr>
                    <th class="th__tb">
                        Rank No.
                    </th>
                    <th class="th__tb">
                        Monthly Traffic
                    </th>
                    <th class="th__tb">
                        CPC
                    </th>

                    <th class="th__tb">
                        Site Demographic
                    </th>
                    <th class="th__tb">
                        Avg Cart Size
                    </th>
                    <th class="th__tb">
                        Monthly Sales
                    </th>
                    <th class="th__tb">
                        Marketing ROAS
                    </th>
                    <th class="th__tb">
                        Marketing Spend
                    </th>
                    <th class="th__tb">
                        Marketing
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- loop --}}
                <?php $i = 1; ?>
                @if (count($current_user_reports))

                @foreach ($current_user_reports as $current_user_report)
                <?php if ($current_user_report->user_id == Auth::user()->id) { ?>
                    <tr class="tr-active">
                        <td class="td__tb">
                            <div class="d-flex gap5 align-item-center justify-content-center">

                                {{$i}}
                            </div>
                        </td>
                        <td class="td__tb"> {{ $current_user_report->traffic }}</td>
                        <td class="td__tb ">
                            <?php if (in_array('marketing_roas', $check_permission)) { ?>
                                $<?= $current_user_report->avg_cpc; ?>
                            <?php } else { ?>
                                <div style="padding: 5px">
                                    <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                </div>
                            <?php } ?>
                        </td>

                        <td style="width: 16%;filter: blur(5px);" class="td__tb">{{ $current_user_report->industriesname}}</td>
                        <td class="td__tb" style="filter: blur(5px);">${{ $userRand}}</td>
                        <td class="td__tb" style="filter: blur(5px);"> $ {{$current_user_report->reach_total}}</td>
                        <!--<td class="td__tb"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>-->
                        <td class="td__tb " style="filter: blur(5px);">
                            @if (in_array('marketing_spend',$check_permission))
                            $ {{$report->spend_total? $report->spend_total:0}}
                            @else
                            <div style="padding: 5px">
                                <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                            </div>
                            @endif
                        </td>
                        <td class="td__tb"  style="filter: blur(5px);">
                            <?php if (in_array('marketing_roas', $check_permission)) { ?>

                                <?php echo number_format($report->roas, 3, '.', ''); ?>X

                            <?php } else { ?>
                                <div style="padding: 5px">
                                    <img src="{{ asset('images/blur-number.png') }}" width="100%" />
                                </div>
                            <?php } ?>
                        </td>
                        
                        <td class="td__tb">
                            <div class="tag__gray">
                                {{ $current_user_report->marketing_type? $current_user_report->marketing_type:'' }}
                            </div>
                        </td>


                    </tr>
                <?php } ?>
                <?php $i++; ?> @endforeach
                @endif


            </tbody>
        </table>
    <?php  } else { ?>

        <div class="add__more  mb-4">
            <a class="" onClick="logInWithFacebookAds()">
                <div class="cdp__btn__add btn btn-primary">
                    + &nbsp;Connect to facebook
                </div>
            </a>
        </div>

    <?php } ?>
    </div>

<?php } ?>

@include('dashboard.components.payment-modal')
@include('dashboard.components.uplgradeModal')