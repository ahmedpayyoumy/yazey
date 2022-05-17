<div class="statistic__section">

    <div class="statistic__box">
        <div class="statistic__header">
            <div class="icon__stt">
                <i class="fas fa-users text-primary icon-2x"></i>
            </div>
        </div>
        <div class="stt__total">
            <div class="head__total">
                TOTAL USERS
            </div>
            <div class="money">
                {{ number_format($general['users']) }}
            </div>
        </div>
    </div>

    <div class="statistic__box">
        <div class="statistic__header">
            <div class="icon__stt">
                <i class="fas fa-laugh text-primary icon-2x"></i>

            </div>
        </div>
        <div class="stt__total">
            <div class="head__total">
                ACTIVE USERS
            </div>
            <div class="money">
                {{ number_format($general['active_visitors']) }}
            </div>
        </div>
    </div>

    <div class="statistic__box">
        <div class="statistic__header">
            <div class="icon__stt">
                <i class="fas fa-chart-line text-primary icon-2x"></i>
            </div>
        </div>
        <div class="stt__total">
            <div class="head__total">
                BOUNCE RATE
            </div>
            <div class="money">
                {{ number_format($general['bounceRate']) }} %
            </div>
        </div>
    </div>

    <div class="statistic__box">
        <div class="statistic__header">
            <div class="icon__stt">
                <i class="fas fa-clock text-primary icon-2x"></i>
            </div>
        </div>
        <div class="stt__total">
            <div class="head__total">
                AVG. SESSION DURATION
            </div>
            <div class="money">
                {{ number_format($general['avgSessionDuration']) }} sec(s)
            </div>
        </div>
    </div>
</div>
