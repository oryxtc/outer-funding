<div class="headTop">
    <div class="header">
        <div class="salogan"></div>
        <input type="hidden" id="isLogin" value="{{auth()->check()}}">
        <p>
            @if(!\Auth::check())
                <span><a href="/login" rel="nofollow">登录</a>|<a href="/register"
                                                                rel="nofollow">免费注册</a></span>
            @else
                <span>用户名:{{auth()->user()->phone}}
                    <a href="/logout" rel="nofollow"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a>
                </span>|
                <a href="/userinfo">个人中心</a>
            @endif
            <span>客服热线：</span><font>0931-8500903</font>
        </p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
