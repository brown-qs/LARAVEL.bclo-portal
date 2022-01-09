<header>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('report', ['type'=>'have_unpaid_payments'])}}"><i class="fa fa-table"></i> Have unpaid payments</a></li>
        <li><a href="{{route('report', ['type'=>'acc_requests'])}}"><i class="fa fa-table"></i> Have ACC requests</a></li>
        <li><a href="{{route('report', ['type'=>'acres_less_1'])}}"><i class="fa fa-table"></i> Less than 1 Acre</a></li>
        <li><a href="{{route('report', ['type'=>'no_mailbox'])}}"><i class="fa fa-table"></i> No Mailbox</a></li>
        <li><a href="{{route('report', ['type'=>'no_mailing_address'])}}"><i class="fa fa-table"></i> No Mailing address</a></li>
        <li><a href="{{route('report', ['type'=>'non_dues_paid'])}}"><i class="fa fa-table"></i> Non dues paid</a></li>
    </ul>
    <nav class="nav-wrapper light-blue darken-1">
        <div class="container">
            @if(!Auth::user())
            <a href="/" class="brand-logo">BCLO</a>
            @else
            <a href="/dashboard" class="brand-logo">BCLO</a>
            @endif

            @if(!Auth::user())
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route('login')}}">Log in</a></li>
            </ul>
            @else
            <ul class="right hide-on-med-and-down">
                <li><a href="/dashboard">Home</a></li>
                <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">Reports <i class="fa fa-angle-down h-auto"></i></a></li>
                <li><a href="">{{Auth::user()->username}}</a></li>
                <li>

                    <a href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">

                        Logout

                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
            @endif
        </div>
    </nav>
</header>

<script>
    $(document).ready(function() {
        $(".dropdown-trigger").dropdown({
            constrainWidth: false
        });
    })
</script>