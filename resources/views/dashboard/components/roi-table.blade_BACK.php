<div class="tb__content datatable datatable-default">

    <table class="table">
        <thead>
            <tr>
                <th class="th__tb">
                    Rank No.
                </th>
                <th class="th__tb">
                    Store Industry
                </th>
                <th class="th__tb">
                    Monthly Traffic
                </th>
                <th class="th__tb">
                    Monthly Spend
                </th>
                <th class="th__tb">
                    Ads Spend
                </th>
                <th class="th__tb">
                    Marketing
                </th>
                <th class="th__tb">
                    Options
                </th>
            </tr>
        </thead>
        <tbody>

            {{-- loop --}}
            @if (count($reports['report']))
                @foreach ($reports['report'] as $key => $report)
                    <tr>
                        <td class="td__tb">
                            <div class="d-flex gap5 align-item-center justify-content-center">
                                <img src="/images/dashboard/arrow-green-table.png" width="20px" height="20px" alt="">
                                {{ ($reports['page'] - 1) * $reports['maxPage'] + $key + 1  }}
                            </div>
                        </td>
                        <td class="td__tb">{{ $report->industry->name }}</td>
                        <td class="td__tb">{{ number_format($report->monthly_traffic) }}</td>
                        <td class="td__tb"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>
                        <td class="td__tb text__bold">{{ number_format($report->ads_spent) }}</td>
                        <td class="td__tb">
                            <div class="tag__green">
                                AGENCY
                            </div>
                        </td>
                        <td class="td__tb">
                            <div class="btn btn__detail">
                                @php
                                    $userSelectAccount = $report->user_selected_account;
                                @endphp
                                <a style="color: unset" href="google-analytics/accounts/detail/{{($userSelectAccount && $userSelectAccount->google_analytics_account_id) ? $userSelectAccount->google_analytics_account_id : ''}}">Details</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td class="td__tb">
                    <div class="d-flex gap5 align-item-center justify-content-center">
                        <img src="/images/dashboard/arrow-green-table.png" width="20px" height="20px" alt="">
                        {{ (($reports['page'] - 1) * $reports['maxPage']) + count($reports['report']) + 1 }}
                    </div>
                </td>
                <td class="td__tb">{{ $userIndustry ?? '' }}</td>
                @if ($userSelectAccount)
                    <td class="td__tb">{{ number_format($totalUsers) }}</td>
                @else
                    <td class="td__tb"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>
                @endif
                <td class="td__tb"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>
                @if ($userSelectAccount)
                    <td class="td__tb">{{ number_format($totalSpend) }}</td>
                @else
                    <td class="td__tb text__bold"><img src="{{ asset('images/blur-number.png') }}" width="45%" /></td>
                @endif
                <td class="td__tb">
                    <div class="tag__green">
                        AGENCY
                    </div>
                </td>
                <td class="td__tb">
                    <div class="btn btn__detail">
                        <a style="color: unset" href="google-analytics/accounts/detail/{{($userSelectAccount && $userSelectAccount->google_analytics_account_id) ? $userSelectAccount->google_analytics_account_id : ''}}">Details</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="datatable-pager datatable-paging-loaded">
        <ul class="datatable-pager-nav">
            <li>
                <a title="First" class="datatable-pager-link datatable-pager-link-first {{ $reports['page'] == 1 ? 'datatable-pager-link-disabled' : ''}}" href="{{ $currUrl }}?page=1" {{ $reports['page'] == 1 ? "disabled" :  "" }}>
                    <i class="flaticon2-fast-back"></i>
                </a>
            </li>
            <li>
                <a title="Previous" class="datatable-pager-link datatable-pager-link-prev {{ ($reports['page'] == 1 ? 'datatable-pager-link-disabled' : '') }}" href="{{ $currUrl }}?page={{$reports['page'] - 1}}" disabled="disabled" {{ $reports['page'] == 1 ? "disabled" :  "" }}>
                    <i class="flaticon2-back"></i>
                </a>
            </li>
            @if (count($reports['listPages']))
                @foreach ($reports['listPages'] as $page)
                    <li>
                        <a href="{{$currUrl}}?page={{$page}}" class="datatable-pager-link datatable-pager-link-number {{$page == $reports['page'] ? 'datatable-pager-link-active' : ''}}" title="{{ $page }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
            <li>
                <a title="Next" class="datatable-pager-link datatable-pager-link-next {{ $reports['page'] == $reports['totalPage'] ? 'datatable-pager-link-disabled' : '' }}" href="{{ $currUrl }}?page={{$reports['page'] + 1}}" {{ $reports['page'] == $reports['totalPage'] ? "disabled" : "" }}>
                    <i class="flaticon2-next"></i>
                </a>
            </li>
            <li>
                <a title="Last" class="datatable-pager-link datatable-pager-link-last {{ $reports['page'] == $reports['totalPage'] ? 'datatable-pager-link-disabled' : '' }}" href="{{ $currUrl }}?page={{$reports['page'] + 1}}" {{ $reports['page'] == $reports['totalPage'] ? "disabled" : "" }}>
                    <i class="flaticon2-fast-next"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
